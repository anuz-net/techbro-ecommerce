-- Update all product prices from USD to NPR (1 USD = 100 NPR)
-- This keeps prices in USD in database but displays as NPR using formatPrice()

-- No database changes needed - prices stay in USD
-- The currency.php helper converts USD to NPR for display only

SELECT 'Currency conversion setup complete. Prices will display in NPR.' as message;
