<?php

/**
 * DocumentResource for handling all document opertaions
 */

namespace Docsecure\Sdk\Resources;

use Docsecure\Sdk\DocsecureClient;

/**
 * Summary of DocumentResource
 */
class DocumentResource extends DocsecureClient
{
    /**
     * Summary of getAll
     * @return array status, statusMessage, message, data[folders]
     * 
     * GET all documents
     */
    public function getAll()
    {
        return $this->request('GET', '/api/v1/documents');
    }

    /**
     * Summary of getAllByFolderId
     * @param int $id - Folder id for filtering documents by folder id
     * @return array status, statusMessage, message, data[folders]
     * 
     * GET all documents fildered by folder ID
     */
    public function getAllByFolderId($id)
    {
        return $this->request('GET', '/api/v1/documents/' . $id);
    }

    /**
     * Summary of new
     * @param mixed $files - Files being uploaded
     * @param string $name
     * POST new document details
     */
    public function new()
    {
        return $this->request('POST', "/api/v1/documents/new/");
    }

    /**
     * Summary of view
     * @param mixed $id
     */
    public function view($id)
    {
        return $this->request('GET', "/api/documents/view/" . $id);
    }

    public function upload($fileData)
    {
        return $this->request('POST', '/api/documents/new', $fileData);
    }
}
