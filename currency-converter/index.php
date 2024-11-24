<?php
// Hard-coded exchange rate (1 USD to INR)
$exchange_rate = 82.50; // Example exchange rate

// Initialize variables
$amount_in_usd = 0;
$amount_in_inr = 0;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount_in_usd = $_POST['amount_in_usd'];

    // Validate input
    if (is_numeric($amount_in_usd) && $amount_in_usd > 0) {
        // Convert USD to INR
        $amount_in_inr = $amount_in_usd * $exchange_rate;
    } else {
        $error_message = "Please enter a valid amount.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Currency Converter</h1>
        <form action="" method="POST">
            <label for="amount_in_usd">Enter Amount in USD:</label>
            <input type="number" name="amount_in_usd" id="amount_in_usd" step="0.01" required>
            <button type="submit">Convert</button>
        </form>

        <?php if (isset($amount_in_inr)): ?>
            <h2>Converted Amount: ₹<?php echo number_format($amount_in_inr, 2); ?></h2>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>