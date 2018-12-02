SELECT seller_initial.*, food_commodity.* FROM seller_initial 
INNER JOIN food_commodity
WHERE seller_initial.seller_sid = ?