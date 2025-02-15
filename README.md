# Code Challenge 20250215

## Overview

This project contains solutions for two questions. The first question involves validating phone numbers using the Telesign API, and the second question involves plotting data points from a CSV file.

### Question 1: Phone Number Validation

The `Question-1` directory contains the following files:

- `config.php`: Contains the configuration details such as phone number, customer ID, and API key.
- `config.sample.php`: A sample configuration file.
- `telesign.php`: Contains the function to validate phone numbers using the Telesign API.

#### Execution

1. Update the `config.php` file with your phone number, customer ID, and API key.
2. Run the `telesign.php` script to validate the phone number.

```sh
php Question-1/telesign.php
```

### Question 2: Data Point Plotting

The `Question-2` directory contains the following files:

- `out.csv`: Contains the data points to be plotted.
- `plot.php`: Reads the data points from out.csv and generates a scatter plot.

#### Execution

1. Ensure out.csv contains the data points you want to plot.
2. Run the plot.php script to generate the scatter plot.

```sh
php Question-2/plot.php
```
