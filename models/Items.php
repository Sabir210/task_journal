<?php

class Items
{

    public static function getItemsById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        $sql = 'SELECT * FROM telephone_directory WHERE id = :id Limit 50';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute();

        return $result->fetch();
    }

    public static function getItemsList()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, first_name, last_name, phone_number, address, city, state,
        zip_code, country, email, notes
        FROM telephone_directory ORDER BY id ASC LIMIT 50');
        $itemsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $itemsList[$i]['id'] = $row['id'];
            $itemsList[$i]['first_name'] = $row['first_name'];
            $itemsList[$i]['last_name'] = $row['last_name'];
            $itemsList[$i]['phone_number'] = $row['phone_number'];
            $itemsList[$i]['address'] = $row['address'];
            $itemsList[$i]['city'] = $row['city'];
            $itemsList[$i]['state'] = $row['state'];
            $itemsList[$i]['zip_code'] = $row['zip_code'];
            $itemsList[$i]['country'] = $row['country'];
            $itemsList[$i]['email'] = $row['email'];
            $itemsList[$i]['notes'] = $row['notes'];
            $i++;
        }
        return $itemsList;
    }

    public static function getCountofAllItems()
    {
        $db = Db::getConnection();

        $result = $db->query("SELECT COUNT(*) as row_count FROM a_logs");

        $totalItems = $result->fetch();

        return $totalItems[0];

    }

    public static function getCountOfSearchedItems()
    {
        if (isset($_GET['query'])) {

            $db = Db::getConnection();

            $startDate = $_GET['start'];
            $endDate = $_GET['end'];
            $teacherId = $_GET['query'];

            $query = 'SELECT COUNT(*) AS count FROM a_logs
                  WHERE added_date >= :startDate
                    AND added_date <= :endDate
                    AND JSON_CONTAINS(posted_json, \'{"teacher_id": "' . $teacherId . '"}\')';

            $statement = $db->prepare($query);
            $statement->bindParam(':startDate', $startDate);
            $statement->bindParam(':endDate', $endDate);

            $statement->execute();

            $count = $statement->fetchColumn();
            return $count;
        }
    }



    public static function deleteItemsById($id)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM telephone_directory WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function updateItemsById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE telephone_directory
            SET
                first_name = :first_name,
                last_name = :last_name,
                phone_number = :phone_number,
                address = :address,
                city = :city,
                state = :state,
                zip_code = :zip_code,
                country = :country,
                email = :email,
                notes = :notes
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':first_name', $options['first_name'], PDO::PARAM_STR);
        $result->bindParam(':last_name', $options['last_name'], PDO::PARAM_STR);
        $result->bindParam(':phone_number', $options['phone_number'], PDO::PARAM_STR);
        $result->bindParam(':address', $options['address'], PDO::PARAM_STR);
        $result->bindParam(':city', $options['city'], PDO::PARAM_STR);
        $result->bindParam(':state', $options['state'], PDO::PARAM_STR);
        $result->bindParam(':zip_code', $options['zip_code'], PDO::PARAM_STR);
        $result->bindParam(':country', $options['country'], PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $result->bindParam(':notes', $options['notes'], PDO::PARAM_STR);
        return $result->execute();
    }

    public static function createItems ($options)
    {

        try {
            $db = Db::getConnection();

            $sql = 'INSERT INTO telephone_directory '
                . '(first_name, last_name, phone_number, address, city, state,'
                . 'zip_code, country, email, notes)'
                . 'VALUES '
                . '(:first_name, :last_name, :phone_number, :address, :city, :state,'
                . ':zip_code, :country, :email, :notes)';

            $result = $db->prepare($sql);
            $result->bindParam(':first_name', $options['first_name'], PDO::PARAM_STR);
            $result->bindParam(':last_name', $options['last_name'], PDO::PARAM_STR);
            $result->bindParam(':phone_number', $options['phone_number'], PDO::PARAM_STR);
            $result->bindParam(':address', $options['address'], PDO::PARAM_STR);
            $result->bindParam(':city', $options['city'], PDO::PARAM_STR);
            $result->bindParam(':state', $options['state'], PDO::PARAM_STR);
            $result->bindParam(':zip_code', $options['zip_code'], PDO::PARAM_STR);
            $result->bindParam(':country', $options['country'], PDO::PARAM_STR);
            $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
            $result->bindParam(':notes', $options['notes'], PDO::PARAM_STR);
            if ($result->execute()) {
                return $db->lastInsertId();
            } else {
                $errorInfo = $result->errorInfo();
                throw new Exception("Database error: " . $errorInfo[2]);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        }

    }
    public static function getLimitItems($leftLimit, $rightLimit) {
        $db = Db::getConnection();

        $query = "SELECT * FROM a_logs AS a
              INNER JOIN teachers AS t ON t.id = a.owner_id
              LIMIT :leftLimit, :rightLimit";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":leftLimit", $leftLimit, PDO::PARAM_INT);
        $stmt->bindParam(":rightLimit", $rightLimit, PDO::PARAM_INT);
        $stmt->execute();
        $aLogsList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Combine the data based on owner_id match
        $combinedList = [];
        foreach ($aLogsList as $aLog) {
            $postedJson = $aLog['posted_json'];
            $jsonData = json_decode($postedJson, true);
            $workerId = $jsonData['worker_id'] ?? '';
            $journalId = $jsonData['journal_id'] ?? '';

            $combinedList[] = [
                'teacher_id' => $aLog['owner_id'],
                'first_name' => $aLog['first_name'],
                'last_name' => $aLog['last_name'],
                'added_date' => $aLog['added_date'],
                'journal_id' => $journalId
            ];
        }

        return $combinedList;
    }


    public static function getLimitSearchItems($leftLimit, $rightLimit) {
        $db = Db::getConnection();

        if (isset($_GET['query'])) {
            $startDate = $_GET['start'];
            $endDate = $_GET['end'];
            $journalId = $_GET['query'];

            $query = 'SELECT a.added_date, a.posted_json, t.first_name, t.last_name
                  FROM a_logs AS a
                  INNER JOIN teachers AS t ON t.id = a.owner_id
                  WHERE a.added_date >= :startDate
                    AND a.added_date <= :endDate';

            $statement = $db->prepare($query);
            $statement->bindParam(':startDate', $startDate);
            $statement->bindParam(':endDate', $endDate);
            $statement->execute();

            $paginationList = [];
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $postedJson = json_decode($row['posted_json'], true);
                if (isset($postedJson['journal_id']) && $postedJson['journal_id'] === $journalId) {
                    $paginationList[] = [
                        'first_name' => $row['first_name'],
                        'last_name' => $row['last_name'],
                        'added_date' => $row['added_date'],
                        'journal_id' => $postedJson['journal_id']
                    ];
                }
            }

            $paginationList = array_slice($paginationList, $leftLimit, $rightLimit);

            return $paginationList;
        }
    }

}
