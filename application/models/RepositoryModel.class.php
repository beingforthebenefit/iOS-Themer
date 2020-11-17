<?php
// application/models/RepositoryModel.class.php

include UTIL_PATH . 'Curl.class.php';

class RepositoryModel extends Model {
    
    // repositories :: void -> [[string -> a]]|false
    public function repositories() {
        $sql = "SELECT * FROM {$this->table} ORDER BY `stars` DESC";
        $repositories = $this->db->rows($sql);

        return $repositories;
    }

    // updateTable
    public function updateTable() {
        $this->truncate();

        $repositories = Curl::url('https://api.github.com/search/repositories?q=language:php&sort=stars&order=desc')['items'];

        foreach ($repositories as $repository) {
            $this->insert([
                'repositoryId' => $repository['id'],
                'name' => $repository['name'],
                'url' => $repository['url'],
                'createdDate' => $repository['created_at'],
                'lastUpdated' => $repository['updated_at'],
                'description' => $repository['description'],
                'stars' => $repository['stargazers_count'],
            ]);
        }
    }
}