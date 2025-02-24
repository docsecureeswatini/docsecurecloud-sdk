<?php

/**
 * DocumentResource for handling all document opertaions
 */

namespace Docsecure\Sdk\Resources;

use Docsecure\Sdk\DocsecureClient;

/**
 * Summary of BranchResource
 */
class BranchResource extends DocsecureClient
{
    /**
     * Summary of getAll
     * @return array status, statusMessage, message, data[branches]
     * 
     * GET all branches
     */
    public function getAll()
    {
        return $this->request('GET', '/api/v1/branches');
    }

    /**
     * Summary of new
     * @param string $branch_name
     * POST new branch details
     */
    public function new()
    {
        return $this->request('POST', "/api/v1/branches/new/");
    }

}
