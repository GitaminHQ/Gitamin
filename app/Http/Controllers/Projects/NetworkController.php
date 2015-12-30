<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Controllers\Projects;

use Gitamin\Http\Controllers\Controller;
use Gitamin\Models\Project;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class NetworkController extends Controller
{
    protected $active_item = 'network';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction($namespace, $project_path)
    {
        $project = Project::findByPath($namespace, $project_path);

        return View::make('projects.network.index')
            ->withProject($project)
            ->withWikis([])
            ->withCurrentBranch('')
            ->withBranches([])
            ->withActiveItem($this->active_item)
            ->withPageTitle(sprintf('%s - %s', trans('dashboard.issues.issues'), $project->name));
    }

    /**
     * Display graph of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function graphAction($namespace, $project_path, $postfix)
    {
        return '{"repo":"battlecity","commitishPath":"master","nextPage":"\/battlecity\/network\/master\/1.json","start":"767ecc9fb65f797edb3a65563253b0757c4d824c","commits":{"767ecc9fb65f797edb3a65563253b0757c4d824c":{"hash":"767ecc9fb65f797edb3a65563253b0757c4d824c","parentsHash":["ddac515901918cbabb448a6ff6efde1509468295"],"date":"1445904248","message":"New functions and event handlers","details":"\/battlecity\/commit\/767ecc9fb65f797edb3a65563253b0757c4d824c","author":{"name":"John Eric","email":"earljohn3ric@gmail.com","image":"\/\/gravatar.com\/avatar\/cf391420a1a19d2db48cf661fe717dc4?s=40"}},"ddac515901918cbabb448a6ff6efde1509468295":{"hash":"ddac515901918cbabb448a6ff6efde1509468295","parentsHash":["95876c4150b944b8ff59eb8c56507674ebd4b500"],"date":"1445904220","message":"Updated the event listeners","details":"\/battlecity\/commit\/ddac515901918cbabb448a6ff6efde1509468295","author":{"name":"John Eric","email":"earljohn3ric@gmail.com","image":"\/\/gravatar.com\/avatar\/cf391420a1a19d2db48cf661fe717dc4?s=40"}},"95876c4150b944b8ff59eb8c56507674ebd4b500":{"hash":"95876c4150b944b8ff59eb8c56507674ebd4b500","parentsHash":["746fc74e6c771b171c908516fc7601e48c68fab7"],"date":"1445904199","message":"Some changes on images and assets","details":"\/battlecity\/commit\/95876c4150b944b8ff59eb8c56507674ebd4b500","author":{"name":"John Eric","email":"earljohn3ric@gmail.com","image":"\/\/gravatar.com\/avatar\/cf391420a1a19d2db48cf661fe717dc4?s=40"}},"746fc74e6c771b171c908516fc7601e48c68fab7":{"hash":"746fc74e6c771b171c908516fc7601e48c68fab7","parentsHash":["cca2930532f636f51a390c8bfe421b24eded6ad4"],"date":"1445824259","message":"Removed the requireJS on lib; doesn\u0027t need right now","details":"\/battlecity\/commit\/746fc74e6c771b171c908516fc7601e48c68fab7","author":{"name":"John Eric","email":"earljohn3ric@gmail.com","image":"\/\/gravatar.com\/avatar\/cf391420a1a19d2db48cf661fe717dc4?s=40"}},"cca2930532f636f51a390c8bfe421b24eded6ad4":{"hash":"cca2930532f636f51a390c8bfe421b24eded6ad4","parentsHash":["75a81af6aa659570ed3ae177bdc0c73e3cdc3987"],"date":"1445820392","message":"Changed the bullet position angle based from the shooter","details":"\/battlecity\/commit\/cca2930532f636f51a390c8bfe421b24eded6ad4","author":{"name":"John Eric","email":"earljohn3ric@gmail.com","image":"\/\/gravatar.com\/avatar\/cf391420a1a19d2db48cf661fe717dc4?s=40"}},"75a81af6aa659570ed3ae177bdc0c73e3cdc3987":{"hash":"75a81af6aa659570ed3ae177bdc0c73e3cdc3987","parentsHash":["91cb4942918bd37957f3c6f653406d8d4cd5e054"],"date":"1445820318","message":"Removed the generated js and css","details":"\/battlecity\/commit\/75a81af6aa659570ed3ae177bdc0c73e3cdc3987","author":{"name":"John Eric","email":"earljohn3ric@gmail.com","image":"\/\/gravatar.com\/avatar\/cf391420a1a19d2db48cf661fe717dc4?s=40"}},"91cb4942918bd37957f3c6f653406d8d4cd5e054":{"hash":"91cb4942918bd37957f3c6f653406d8d4cd5e054","parentsHash":["893ca5cc9dc3d18f6a363fad80dddec79d20d392"],"date":"1445820224","message":"Changes to ignore some files","details":"\/battlecity\/commit\/91cb4942918bd37957f3c6f653406d8d4cd5e054","author":{"name":"John Eric","email":"earljohn3ric@gmail.com","image":"\/\/gravatar.com\/avatar\/cf391420a1a19d2db48cf661fe717dc4?s=40"}},"893ca5cc9dc3d18f6a363fad80dddec79d20d392":{"hash":"893ca5cc9dc3d18f6a363fad80dddec79d20d392","parentsHash":["bf4c10fc58004eacf20d04cc765acaa39f5643f5"],"date":"1445819873","message":"Added the requireJS lib","details":"\/battlecity\/commit\/893ca5cc9dc3d18f6a363fad80dddec79d20d392","author":{"name":"John Eric","email":"earljohn3ric@gmail.com","image":"\/\/gravatar.com\/avatar\/cf391420a1a19d2db48cf661fe717dc4?s=40"}},"bf4c10fc58004eacf20d04cc765acaa39f5643f5":{"hash":"bf4c10fc58004eacf20d04cc765acaa39f5643f5","parentsHash":["78e547c24453e6c7e96ec0e6035efd105212cc73"],"date":"1445720610","message":"Fixed the bullet collision on wall Hit","details":"\/battlecity\/commit\/bf4c10fc58004eacf20d04cc765acaa39f5643f5","author":{"name":"John Eric","email":"earljohn3ric@gmail.com","image":"\/\/gravatar.com\/avatar\/cf391420a1a19d2db48cf661fe717dc4?s=40"}},"78e547c24453e6c7e96ec0e6035efd105212cc73":{"hash":"78e547c24453e6c7e96ec0e6035efd105212cc73","parentsHash":["8bef3826ed2bc272a5e5334125296e773612b938"],"date":"1445552835","message":"Some changes on the world level and assets","details":"\/battlecity\/commit\/78e547c24453e6c7e96ec0e6035efd105212cc73","author":{"name":"John Eric","email":"earljohn3ric@gmail.com","image":"\/\/gravatar.com\/avatar\/cf391420a1a19d2db48cf661fe717dc4?s=40"}},"8bef3826ed2bc272a5e5334125296e773612b938":{"hash":"8bef3826ed2bc272a5e5334125296e773612b938","parentsHash":["df9db020878f5374d0a5d9e6c76744c983da07b5"],"date":"1445386087","message":"Changes on wall collision, player controls and camera","details":"\/battlecity\/commit\/8bef3826ed2bc272a5e5334125296e773612b938","author":{"name":"John Eric","email":"earljohn3ric@gmail.com","image":"\/\/gravatar.com\/avatar\/cf391420a1a19d2db48cf661fe717dc4?s=40"}},"df9db020878f5374d0a5d9e6c76744c983da07b5":{"hash":"df9db020878f5374d0a5d9e6c76744c983da07b5","parentsHash":["a6a320393e71e94ddb71d3f9a7064b880ad30bff"],"date":"1445386051","message":"Add a poc image for player","details":"\/battlecity\/commit\/df9db020878f5374d0a5d9e6c76744c983da07b5","author":{"name":"John Eric","email":"earljohn3ric@gmail.com","image":"\/\/gravatar.com\/avatar\/cf391420a1a19d2db48cf661fe717dc4?s=40"}},"a6a320393e71e94ddb71d3f9a7064b880ad30bff":{"hash":"a6a320393e71e94ddb71d3f9a7064b880ad30bff","parentsHash":["b513034bab18d2e369f5e5e9d05dbceb32179cc5"],"date":"1445386028","message":"Updated the sample map for collision layer","details":"\/battlecity\/commit\/a6a320393e71e94ddb71d3f9a7064b880ad30bff","author":{"name":"John Eric","email":"earljohn3ric@gmail.com","image":"\/\/gravatar.com\/avatar\/cf391420a1a19d2db48cf661fe717dc4?s=40"}},"b513034bab18d2e369f5e5e9d05dbceb32179cc5":{"hash":"b513034bab18d2e369f5e5e9d05dbceb32179cc5","parentsHash":["036e2e9def6e1083d9972e9312068032b68031f2"],"date":"1445380205","message":"Changes on design","details":"\/battlecity\/commit\/b513034bab18d2e369f5e5e9d05dbceb32179cc5","author":{"name":"John Eric","email":"earljohn3ric@gmail.com","image":"\/\/gravatar.com\/avatar\/cf391420a1a19d2db48cf661fe717dc4?s=40"}},"036e2e9def6e1083d9972e9312068032b68031f2":{"hash":"036e2e9def6e1083d9972e9312068032b68031f2","parentsHash":["a6846d037f36d11d7f0aede7240acf45a8fcf79b"],"date":"1445295773","message":"Generic files for POC Phase","details":"\/battlecity\/commit\/036e2e9def6e1083d9972e9312068032b68031f2","author":{"name":"John Eric","email":"earljohn3ric@gmail.com","image":"\/\/gravatar.com\/avatar\/cf391420a1a19d2db48cf661fe717dc4?s=40"}}}}';
        //return Response::json(['status' => 1]);
    }
}
