<?php
    class JsonStorage {
        
        private $filePath;

        public function __construct($filePath) {
            $this->filePath = $filePath;
            // Asegurarse de que el archivo JSON exista
            if (!file_exists($this->filePath)) {
                file_put_contents($this->filePath, json_encode([]));
            }
        }

        // Agregar un nuevo campo
        public function addField($key, $value) {
            $data = $this->readData();
            $data[$key] = $value;
            $this->writeData($data);
        }

        // Eliminar un campo
        public function deleteField($key) {
            $data = $this->readData();
            if (isset($data[$key])) {
                unset($data[$key]);
                $this->writeData($data);
            }
        }

        // Actualizar un campo
        public function updateField($key, $value) {
            $data = $this->readData();
            if (isset($data[$key])) {
                $data[$key] = $value;
                $this->writeData($data);
            }
        }

        // Leer los datos del archivo
        private function readData() {
            $jsonData = file_get_contents($this->filePath);
            return json_decode($jsonData, true);
        }

        // Escribir datos en el archivo
        private function writeData($data) {
            file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
        }

        // Mostrar todos los datos
        public function getAllFields() {
            return $this->readData();
        }
    }


?>
