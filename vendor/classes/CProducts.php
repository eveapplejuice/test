<?
class CProducts
{
    const host = 'localhost';
    const user = 'root';
    const password = 'root';
    const dbname = 'work_test';

    const tableName = 'products';

    public static function dump($array)
    {
        ?><pre>
        <?print_r($array);?>
        </pre><?
    }

    public static function connectDB(): false|mysqli
    {
        return mysqli_connect(self::host, self::user, self::password, self::dbname);
    }

    /**
     * @param integer $quantity задает ограничение по количеству товаров
     * @param bool $order определяет необходимость сортировки
     */

    public static function getProducts($quantity = false, $order = false)
    {
        $query = 'SELECT ID, 
       PRODUCT_ID, 
       PRODUCT_NAME, 
       PRODUCT_PRICE, 
       PRODUCT_ARTICLE, 
       PRODUCT_QUANTITY, 
       DATE_CREATE
       FROM ' . self::tableName . ' WHERE PRODUCT_HIDE = "N"';

        if ($order) $query .= ' ORDER BY DATE_CREATE DESC';

        if ($quantity && gettype($quantity) == 'integer') $query .= ' LIMIT ' . $quantity;

        $res_query = mysqli_query(self::connectDB(), $query) or die(mysqli_error(self::connectDB()));

        $result = [];

        while ($row = mysqli_fetch_assoc($res_query)) {
            $result[] = $row;
        }

        foreach ($result as &$value) {
            $value['DATE_CREATE'] = date('d.m.Y H:i', strtotime($value['DATE_CREATE']));
        }
        return $result;

    }

    /**
     * @param int $id id пользователя
     * @param array $valuesArray ассоциативный массив вида ['столбец' => 'значение']
     */
    public static function updateDB($id, $valuesArray)
    {
        $query = 'UPDATE ' . self::tableName . ' SET ' . self::generateSetRow($valuesArray) . ' WHERE ID = ' . $id;
        return mysqli_query(self::connectDB(),$query) or die(mysqli_error(self::connectDB()));
    }

    /**
     * Функция принимает на вход ассоциативный массив и разбивает его на строку для дальнейшей работы с MySQL UPDATE
     * @param array $array ассоциативный массив
     */

    public static function generateSetRow($array): string
    {
        $row = '';
        foreach ($array as $key => $value) {
            if ($row == '') {
                $row .= $key . ' = ';
            } else {
                $row .= ', ' . $key . ' = ';
            }
            if (gettype($value) == 'integer') {
                $row .= $value;
            } else {
                $row .= '"' . htmlspecialchars($value) . '"';
            }
        }
        return $row;
    }
}
