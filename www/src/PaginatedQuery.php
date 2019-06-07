<?php
namespace App;


class PaginatedQuery
{
    private $queryCount;

    private $query;

    private $classMapping;

    private $perpage;

    private $url;

    private $pdo;

    private $nbPage;

    private $currentpage;

    public function __construct(
        string $queryCount,
        string $query,
        string $classMapping,
        string $url,
        int $perpage = 12
    ){
        $this->queryCount = $queryCount;
        $this->query = $query;
        $this->classMapping = $classMapping;
        $this->url = $url;
        $this->perpage = $perpage;
        $this->pdo = Connection::getPDO();

    }
    public function getItems(): ?array
    {
        $nbpost = $this->pdo->query($this->queryCount)->fetch()[0];
        $this->nbPage = ceil($nbpost / $this->perpage);
        if ((int)$_GET["page"] > $this->nbPage) {
            throw new Exception('pas de pages');
        }
        if (isset($_GET["page"])) {
        $this->currentpage = (int)$_GET["page"];
        } else {
            $this->currentpage = 1;
        }
        $offset = ($this->currentpage - 1) * $this->perpage;
        $statement = $this->pdo->query(
                            $this->query."
                            LIMIT {$this->perpage} 
                            OFFSET {$offset}");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->classMapping);
        /**@var Post[]|false */
        return $statement->fetchAll();
    }   
    public function getNavHTML(): void 
    {
        $uri = $this->url;
        for ($i = 1; $i <= $this->nbPage; $i++){
            $class = $this->currentpage == $i ? " active" : "";
            $this->url = $i == 1 ? $uri : $uri . "?page=" . $i; 
           echo '<li class="page-item'.$class.'"><a class="page-link" href="'. $this->url .'">'. $i .'</a></li>';
        }
    }
}