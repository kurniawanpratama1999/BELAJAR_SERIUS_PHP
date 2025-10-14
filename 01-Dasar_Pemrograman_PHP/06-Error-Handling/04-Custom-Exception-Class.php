<?php
// exceptions.php
/*
5) Custom exception class
- Buat exception khusus untuk menandakan domain error:
*/
class AppException extends Exception
{
}
class ValidationException extends AppException
{
}
class DatabaseException extends AppException
{
}

/*
Gunakan throw new ValidationException("...") lalu catch (ValidationException $e) untuk handling khusus.
*/