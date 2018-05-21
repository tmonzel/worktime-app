'use strict';

const express = require('express');
const PORT = 8080;
const HOST = '0.0.0.0';

// Create express application
var app = express();

// Serve public statics only
app.use(express.static('public'));

// Run app
app.listen(PORT, HOST);
console.log(`Running on http://${HOST}:${PORT}`);