<?php

/**
 * DocumentResource for handling all document opertaions
 */

namespace Docsecure\Sdk\Resources;

use Docsecure\Sdk\DocsecureClient;

/**
 * Summary of DocumentResource
 */
class FolderResource extends DocsecureClient
{
    /**
     * Summary of getAll
     * @return array status, statusMessage, message, data[folders]
     * 
     * GET all folders
     */
    public function getAll()
    {
        return $this->request('GET', '/api/v1/folders');
    }

    /**
     * Summary of getAllByBranchId
     * @param int $id - Branch id for filtering folders by branch id
     * @return array status, statusMessage, message, data[folders]
     * 
     * GET all folders fildered by branch ID
     */
    public function getAllByBranchId($id)
    {
        return $this->request('GET', '/api/v1/folders/' . $id);
    }

    /**
     * Summary of new
     * @param string $folder_name
     * POST new folder details
     */
    public function new()
    {
        return $this->request('POST', "/api/v1/folders/new/");
    }

}
