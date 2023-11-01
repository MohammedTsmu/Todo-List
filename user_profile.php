<!DOCTYPE html>
<html>
<head>
  <title>User Profile</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <h1>User Profile</h1>
  <form id="theme-form">
    <label for="theme">Select Theme:</label>
    <select name="theme" id="theme-selector">
      <option value="light">Light</option>
      <option value="dark">Dark</option>
      <option value="heather_blue">Heather Blue</option>
    </select>
    <input type="submit" value="Save Theme Preferences">
  </form>

<?php include ('footer.php'); ?>