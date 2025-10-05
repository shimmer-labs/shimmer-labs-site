<?php

return [
  'url' => $_SERVER['SERVER_NAME'] === 'localhost' 
    ? 'http://localhost:8000' 
    : 'https://shimmerlabs.co'
];