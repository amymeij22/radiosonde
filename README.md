
## Project Description

This project is a dashboard for monitoring radiosonde data, including temperature, humidity, air pressure, altitude, longitude, and latitude. The dashboard updates data automatically every 5 seconds.

## Features

- Automatically updates data every 5 seconds.
- Displays temperature, humidity, air pressure, altitude, longitude, and latitude data.
- Downloads data in CSV format.

## Installation

1. Clone this repository to your local machine:

    ```bash
    git clone https://github.com/amymeij22/radiosonde.git
    ```

2. Navigate to the project directory:

    ```bash
    cd radiosonde
    ```
3. Configure the database at `./connection/get-data.php` and `./connection/download.php`

   ```bash
    $hostname = "localhost"; \\
    $username = "root";
    $password = "";
    $database = "radiosonde_db";
    ```
3. Open the `index.php` file using a web browser to view the dashboard.

## Usage

- Open the `index.php` file in your web browser.
- The dashboard will automatically update data every 5 seconds.
- Click the "Download Data (.csv)" button to download radiosonde data in CSV format.

## Contributions

If you'd like to contribute to this project, please open a pull request. We greatly appreciate contributions from the community.

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).
