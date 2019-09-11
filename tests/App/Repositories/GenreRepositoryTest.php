<?php


namespace Tests\App\Repositories;


use Exception;
use Foundation\Database\Pagination\PaginatorBuilder;
use UpcomingMovies\Repositories\GenreRepository;

class GenreRepositoryTest extends RepositoryTest
{

    /**
     * @var GenreRepository
     */
    private $repository;

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new GenreRepository();
    }

    /**
     * @throws Exception
     */
    public function testInsertOneRecord(): void
    {
        $genre = ['name' => 'Action','tmdb_id' => 1];
        $genre = $this->repository->store($genre);
        $this->assertIsObject($genre);
        $this->assertEquals('Action', $genre->name);
    }


    /**
     * Test get one genre
     */
    public function testRetrieveGenre(): void
    {
        $genre = ['name' => 'Action','tmdb_id' => 1];
        $genre = $this->repository->store($genre);
        $genre = $this->repository->find($genre->id);
        $this->assertIsObject($genre);
        $this->assertEquals('Action', $genre->name);
    }

    /**
     * Test pagination
     */
    public function testPagination(): void
    {
        $paginatorBuilder = new PaginatorBuilder();
        $paginatorBuilder->setPage(1);
        $paginatorBuilder->setPageLength(3);
        $paginatorBuilder->setOrderBy('name');
        $paginatorBuilder->setDesc(false);
        $paginatorBuilder->setFieldsToFilter(['name']);
        $paginatorBuilder->setFilter('s');
        $page = $this->repository->paginate($paginatorBuilder);
        $this->assertIsArray($page->toArray());

    }

    /**
     * Find tmdb ids
     */
    public function testFindTheseImdbsCorrect(): void
    {
        $genre = ['name' => 'Some name A', 'tmdb_id' => 2];
        $genreA = $this->repository->store($genre);

        $genre = ['name' => 'Some name B', 'tmdb_id' => 3];
        $genreB = $this->repository->store($genre);
        $ids = $this->repository->findTheseTmdbIds([2,3]);
        $this->assertIsArray($ids->toArray());
    }

}