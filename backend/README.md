## Backend

To change database settings and other things edit this file `api/config.php`

*Important: do not delete this file `api_auth_token` it is used to cache the authorization token (you can clear the content if you need to)*

### Database

This app require one table with already populated rows, use the following SQL query to create it

```sql
CREATE TABLE IF NOT EXISTS `settings` (
  `skey` varchar(50) DEFAULT NULL,
  `value` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `settings` (`skey`, `value`) VALUES
	('graphql_endpoint', ''),
	('client_id', ''),
	('client_secret', ''),
	('nin', ''),
	('payment_account_number', '');

```