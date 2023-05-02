
# Dataset Working Service

A service for working with a dataset



## Author

[@zauradigozalov](https://www.github.com/zauradigozalov)


## Run Locally

Clone the project

```bash
  git clone https://github.com/zauradigozalov/dataset-working-service
```

Go to the project directory

```bash
  cd dataset-working-service
```

Run the application in Docker using Sail

```bash
  ./vendor/bin/sail up -d
```

Database migration automatically imports the given CSV file

```bash
  ./vendor/bin/sail artisan migrate --seed
```


## API Reference

#### Get all data - json response

```http
  GET /api/clients
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `page` | `string` | **Optional**. Client per page. By default: 20 |

#### Get data via filtered options - csv formatted response

```http
  GET /api/clients/csv
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `filter[category]`      | `string` | **Optional**. Category value for filter. Example: filter[category]=toys |
| `filter[gender]`      | `string` | **Optional**. Gender value for filter. Example: filter[gender]=male |
| `filter[date_of_birth]`      | `string` | **Optional**. Date of birth of client for filter. Example: filter[date_of_birth]=1975-05-01 |
| `filter[age_range]`      | `string` | **Optional**. Age range for filter. Should be placed as single age or a range Example: filter[age_range]=25,  filter[age_range]=25-35|
