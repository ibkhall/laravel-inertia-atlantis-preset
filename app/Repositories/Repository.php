<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Repository
 * @package App\Repositories
 */
class Repository {

    /**
     * @var Model
     */
   protected $model;

    /**
     * @var array
     */
   protected $searchables = ['id'];


    /**
     * Repository constructor.
     * @param Model $model
     */
   public function __construct(Model $model)
   {
       $this->model = $model;
   }


    /**
     * retrieve all records
     * @return Builder[]|Collection
     */
    public function list()
    {
        return $this->query()->get();
    }

    /**
     * retieve an item
     * @param int $id
     * @return Model|null
     */
    public function find(?int $id): ?Model
    {
        return $this->model->newQuery()->find($id);
    }

    /**
     * insert record
     * @param array $data
     * @return Model
     */
    public function insert(array $data): Model {
        $item = $this->model->newQuery()->create($data);
        return $item;
    }


    /**
     * update record
     * @param int $id
     * @param array $data
     */
    public function update(int $id, array $data) {
        $this->model
                ->newQuery()
                ->where('id', $id)
                ->update($data);

    }


    /**
     * deleting item
     * @param int $id
     */
    public function delete(int $id) {
      $this->model
            ->newQuery()
            ->where('id', $id)
            ->delete();
    }

    /**
     *
     * @return Builder
     */
    public function query() {

        return $this->model->newQuery();
    }

    /**
     * search records
     * @param string|null $text
     * @return Builder
     */
    public function search(string $text=null) {
        if($text) {
            $query = $this->query();
            foreach ($this->searchables as $searchable) {
                $parts = explode('.', $searchable);
                if(count($parts) > 1) {
                    $query->orWhereHas($parts[0], function (Builder $query) use ($text, $parts){
                        $query->where($parts[1], 'like', "%$text%");

                    });
                }else {

                    $query->orWhere($searchable, 'like', "%$text%");
                }
            }
            return $query;
        }
        return $this->query();
    }

}
