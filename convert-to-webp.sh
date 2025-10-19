#!/bin/bash

# WebP Image Conversion Script
# Converts JPG and PNG images to WebP format for better performance
# Keeps originals as fallbacks

echo "Starting WebP conversion..."

# Check if cwebp is installed
if ! command -v cwebp &> /dev/null; then
    echo "Error: cwebp is not installed."
    echo "Install with: brew install webp (macOS) or apt-get install webp (Linux)"
    exit 1
fi

# Find all JPG and PNG files
find assets/images content/projects -type f \( -iname "*.jpg" -o -iname "*.jpeg" -o -iname "*.png" \) | while read file; do
    # Skip if WebP already exists
    webp_file="${file%.*}.webp"
    if [ -f "$webp_file" ]; then
        echo "Skipping $file (WebP already exists)"
        continue
    fi

    # Convert to WebP
    echo "Converting: $file"
    cwebp -q 85 "$file" -o "$webp_file"

    if [ $? -eq 0 ]; then
        original_size=$(stat -f%z "$file" 2>/dev/null || stat -c%s "$file")
        webp_size=$(stat -f%z "$webp_file" 2>/dev/null || stat -c%s "$webp_file")
        savings=$(echo "scale=2; ($original_size - $webp_size) * 100 / $original_size" | bc)
        echo "✓ Saved ${savings}% ($original_size → $webp_size bytes)"
    else
        echo "✗ Failed to convert $file"
    fi
done

echo ""
echo "Conversion complete!"
echo "Original images preserved as fallbacks."
