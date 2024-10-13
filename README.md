# Commission Calculator API

This project is a simple Lumen-based API with a single endpoint designed to support a commission calculator application. It provides functionality to calculate commissions based on revenue and various commission models.

## Project Overview

The Commission Calculator API is built using Lumen PHP framework. The API has a single endpoint to calculate commissions based on revenue and different commission models. The commission models are stored in a database, so they can be updated easily without changing the code.

This API can be useful for businesses that need to calculate sales commissions based on different revenue tiers and commission structures.

## Features
- **Single Endpoint**: The API features a `/calculate-commission` endpoint that accepts revenue and model type as input, then returns the calculated commission and a breakdown of the tiers.
- **Commission Models**: Dynamic calculation of commissions using different models that are easily manageable through a database.
- **Breakdown of Tiers**: Returns a detailed breakdown showing commission percentages for different revenue tiers.

## Setup
1. **Clone the repository**:
   ```bash
   git clone https://github.com/luccacastro/commissionAPI
   ```
2. **Install dependencies**:
   ```bash
   composer install
   ```
3. **Run Migrations**:
   ```bash
   php artisan migrate
   ```
4. **Seed Database**:
   ```bash
   php artisan db:seed --class=CommissionModelsSeeder
   ```

## Usage
- **Endpoint**: `/calculate-commission`
- **Method**: `POST`
- **Request Parameters**:
  - `revenue` (required, numeric): The revenue amount to calculate commission on.
  - `modelType` (required, string): The type of commission model to use.

### Example Request
```json
{
  "revenue": 25000,
  "modelType": "default"
}
```

### Example Response
```json
{
  "commission": 3500,
  "breakdown": [
    { "label": "£15k - £20k (25%)", "limit": 20000, "rate": 0.25 },
    { "label": "£10k - £15k (20%)", "limit": 15000, "rate": 0.20 },
    { "label": "£5k - £10k (15%)", "limit": 10000, "rate": 0.15 },
    { "label": "£0 - £5k (10%)", "limit": 5000, "rate": 0.10 }
  ]
}
```
