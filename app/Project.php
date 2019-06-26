<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Project extends ESLModel
{
    protected $table = 'Project';
    protected $primaryKey = 'ProjectLink';
    protected $connection = 'sqlsrv2';
    public $timestamps = false;

    protected $fillable = ['ProjectName','ProjectCode','ActiveProject','MasterSubProject',
        'ProjectDescription','ProjectLevel','Project_iChangeSetID','Project_iCreatedAgentID',
        'Project_iCreatedBranchID','Project_iModifiedAgentID','Project_iModifiedBranchID','SubProjectOfLink',
        'Project_Checksum','Project_dCreatedDate','Project_dModifiedDate','Project_iBranchID'];
}
