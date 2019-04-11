<?php 
namespace App\Lib;
use Algolia\AlgoliaSearch\SearchClient;
use Cake\Core\Configure;
use Cake\Log\Log;

class SearchIndexClient {
    public function __construct()
    {
        $indexName = Configure::read('SearchIndexer.index');
        $appId = Configure::read('SearchIndexer.application_id');
        $apiKey = Configure::read('SearchIndexer.admin_api_key');

        $this->searchClient = SearchClient::create($appId, $apiKey);
        $this->index = $this->searchClient->initIndex($indexName);
    }

    public function indexOne($data)
    {
        try{
            Log::write('debug', __('Indexing record: {0}', json_encode($data)));
             $this->index->saveObject($data);
        }catch(\Exception $e)
        {
            Log::write('error', __('Indexing error: {0}', $e->getMessage()));
            return false;
        }
        return true;
    }

    public function replaceAll($batch)
    {
        try{
            Log::write('debug', __('Replacement batch: {0}', json_encode($batch)));
            $this->index->replaceAllObjects($batch, ['safe'=>true]);
        }catch(\Exception $e)
        {
            Log::write('error', __('Index replacement error: {0}', $e->getMessage()));
            return false;
        }
        return true;
    }

    public function batchIndex($batch)
    {
        try{
            Log::write('debug', __('Index batch: {0}', json_encode($batch)));
            $this->index->saveObjects($batch);
        }catch(\Exception $e)
        {
            Log::write('error', __('Batch indexing error: {0}', $e->getMessage()));
            return false;
        }
       return true;
    }
}