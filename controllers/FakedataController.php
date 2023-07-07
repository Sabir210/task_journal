<?php

/**
 * Класс FakeDataController
 */
class FakeDataController
{

    /**
     * Action для фейковых данных
     */
    public function actionIndex() {
        $db = Db::getConnection();

        $insertQuery = "INSERT INTO telephone_directory (first_name, last_name, phone_number, address, city, state, zip_code,
                        country, email, notes, created_at, updated_at)
               VALUES (:first_name, :last_name, :address, :phone_number  ,:city, :state, :zip_code, :country, :email, :notes,
                       :created_at, :updated_at)";

        $stmt = $db->prepare($insertQuery);

        $firstNames = ['Lisa', 'Jane', 'Michael', 'Emily', 'David', 'Andrei', 'Semen', 'Sergey', 'Lara', 'James',
            'Kate', 'Ali', 'Vaqif']; // Массив имен
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Jackson', 'Garcia', 'Miller', 'Rodriguez',
            'Hernandez', 'Wilson', 'Garayzadeh', 'Abdulzadeh', 'Lotfizadeh']; // Массив фамилий
        $countries = ['USA', 'Canada', 'UK', 'Azerbaijan', 'Russia', 'Australia', 'Germany', 'Estonia']; // Массив стран

        for ($i = 0; $i < 1000000; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $phoneNumber = '123-456-' . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $email = strtolower($firstName . '.' . $lastName . '@example.com');
            $address = 'Address ' . mt_rand(1, 100);
            $city = 'City ' . mt_rand(1, 10);
            $state = 'State ' . mt_rand(1, 5);
            $zipCode = 'Zip ' . mt_rand(10000, 99999);
            $country = $countries[array_rand($countries)];
            $notes = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
            $createdAt = date('Y-m-d H:i:s');
            $updatedAt = date('Y-m-d H:i:s');

            $stmt->execute([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'phone_number' => $phoneNumber,
                'email' => $email,
                'address' => $address,
                'city' => $city,
                'state' => $state,
                'zip_code' => $zipCode,
                'country' => $country,
                'notes' => $notes,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }

    }
}
