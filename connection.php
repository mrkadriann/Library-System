<?php
// connection.php
$conn = oci_connect('LibraryDB', 'Library2025', 'localhost:1521/orcl');

if (!$conn) {
    handle_error('Failed to connect to the database: ' . oci_error());
}