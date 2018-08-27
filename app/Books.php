<?php
namespace App;
use cassandra\sonvq\Cassandra\Eloquent\Model;
class Books extends Model
{
protected $connection = 'cassandra';
 protected $collection = 'posts';
}
