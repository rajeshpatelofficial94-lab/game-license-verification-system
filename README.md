# Game License Verification System

A modern web application for verifying game licenses, checking regional restrictions, validating age ratings, and ensuring GDPR compliance for gaming platforms. Built with Laravel, Inertia.js, Vue 3, and Tailwind CSS.
## Output

<img width="1676" height="918" alt="screenshot" src="https://github.com/user-attachments/assets/3ee16d09-7d01-4d71-a04c-f8728580026e" />

## Features

- **License Authenticity Verification**
  - Verify if a game license is valid for a given region.
  - Input: Game ID and Region (e.g., US, EU, JP).

- **GDPR Compliance for Regions**
  - View available regions for a game, excluding GDPR-restricted regions.
  - Input: Game ID.

- **Regional Restriction Checking**
  - Check which regions are restricted for a game, with GDPR filtering.
  - Input: Game ID.

- **Age Rating Validation**
  - Validate if a user meets the age requirement for a game.
  - Input: Game ID and User ID (e.g., 1 or 2).

## UI & Navigation

- Single-page navigation with sidebar links to all features.
- Responsive, modern design using Tailwind CSS.
- Consistent form validation and error messaging.
- Testing guidelines are always visible for easy reference.

## Getting Started

1. **Install dependencies**
   ```bash
   composer install
   npm install
   npm run dev
   ```
2. **Run the Laravel server**
   ```bash
   php artisan serve
   ```
3. **Access the app**
   - Open [http://localhost:8000](http://localhost:8000) in your browser.
   - Use the sidebar to navigate between features.

## Testing Guidelines

- Use `game-1` or `game-2` as Game ID for all features.
- For License authenticity, enter a valid Game ID and Region (US, EU, JP).
- For GDPR compliance, enter a valid Game ID and click "Get Regions".
- For regional restrictions, enter a valid Game ID and click "Check".
- For age validation, enter a valid Game ID and User ID (1 or 2).
- All forms have client-side validation. Try submitting with empty fields to see error messages.

## Tech Stack

- **Backend:** Laravel
- **Frontend:** Vue 3, Inertia.js
- **Styling:** Tailwind CSS

## License

MIT
