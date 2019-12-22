<template>
    <div class="container">
        <div class="row mt-5">
<!--         <div class="row justify-content-between mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                123
            </div>
        </div> -->
            <div class="col-md-3">
                <div class="d-flex">
                    <div class="user-profile border border-primary rounded-circle mb-2" @click="profile()">
                        AI
                    </div>
                    <div class="profile-option ml-3">
                        <li>View profile</li> <!-- router link -->
                        <li class="active">Task calendar</li>
                        <li>Settings</li>
                        <hr class="mt-1 mb-1">
                        <li>Log out</li>
                    </div>
                </div>
                <hr class="mt-1 mb-3">
                <h4 class="d-flex justify-content-between">My boards <span>-</span></h4>
                <ul class="list-group left-menu sm">
                  <li class="">Cras justo odio <i class="fa fa-pencil"></i></li>
                  <li class="active">Dapibus ac facilisis in <i class="fa fa-pencil"></i></li>
                  <li class="">Morbi leo risus <i class="fa fa-pencil"></i></li>
                  <li class="">Porta ac consectetur ac <i class="fa fa-pencil"></i></li>
                  <li class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores iste perspiciatis iure, voluptate, id blanditiis. <i class="fa fa-pencil"></i></li>
                  <li class="add-task">Add task +</li>
                </ul>
                <div class="asode-tasks mt-3 mb-3">
                    <h4 class="d-flex justify-content-between">Today tasks <span>+</span></h4>
                </div>    
            </div>
            <div class="col-md-9">
                <div class="col-md-12">
                    <h3>Dapibus ac facilisis in
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <div class="board-contributors">
                            <small class="task-autor form-text text-muted mt-1 mb-1">Autor: <span class="element-outline-primary">Aidar Ilyasov</span></small>
                            <small class="task-assistant text-muted">Invited: 
                                <span class="element-outline-primary">David Guetta <i class="fa fa-close"></i></span>
                                <span class="element-outline-primary">Andrey Balik <i class="fa fa-close"></i></span>
                            </small>
                        </div>
                    </h3>
                </div>
                <hr>
                <div class="col-md-12">
                    <button class="btn btn-outline-primary btn-sm"><i class="fa fa-star"></i> Favorite</button>
                    <button class="btn btn-outline-primary btn-sm"><i class="fa fa-lock"></i> Private</button>
                    <button class="btn btn-outline-primary btn-sm"><i class="fa fa-user-plus"></i> Invite</button>
                    <button class="btn btn-outline-primary btn-sm"><i class="fa fa-picture-o"></i> Change wallpaper</button>
                    <button class="btn btn-outline-primary btn-sm change-view"><i class="fa fa-bars"></i></button>
                </div>
                <div class="col-md-12">
                    <div class="card bg-light mt-3 p-0 col-md-4">
                      <div class="card-header task-title">
                        <h5 class="card-title mb-0 d-flex justify-content-between">Light card title <span class="contributor-message"><span class="fa fa-comment-o"></span></span></h5>
                        <div class="task_title-option align-items-center justify-content-around">
                            <i class="fa fa-pencil-square-o" title="edit task"></i>
                            <i class="fa fa-star-o" title="set as favorite"></i>
                            <i class="fa fa-user-plus" title="appoint a person"></i>
                            <i class="fa fa-trash-o" title="remove task"></i>
                        </div>
                      </div>
                      <div class="card-body task-body">
                        <p class="task-text">
                            Some quick example text to build on the 
                            card title and make up the bulk of the card's content.
                        </p>
                        <ul class="task-list">
                            <li><i class="fa fa-square-o"></i> task one</li>
                            <li><i class="fa fa-check-square-o"></i> task two</li>
                            <li><i class="fa fa-square-o"></i> task three</li>
                        </ul>
                      </div>
                      <div class="task-footer bg-transparent border-primary">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="task-contributors d-flex">
                                    <div class="contributor-profile">DG</div>
                                    <div class="contributor-profile">AB</div>
                                </div>
                                <strong>15.12.19 23:09</strong>
                            </div>
                      </div>
                    </div>
                </div>    
            </div>
        </div>    
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            profile(){
                console.log("Profile");
            }
        }
    }
</script>

<style lang="scss">
    body{
        background-color: #fff;
    }
    .add-task{
        color: #3d91cd;
        font-weight: bold;
        text-align: center;
    }
    .change-view{
        margin: 0 0 0 auto;
    }
    .card{
        border-radius: 0;
    }
    .task-title{
        padding: 0.5rem 1rem;
        cursor: pointer;
        position: relative;
        transition: .3s;
        &:hover > .task_title-option{
            display: flex;
        }
    }
    .task_title-option{
        position: absolute;
        top: 0;
        height: 100%;
        width: 100%;
        left: 0;
        padding: 0 10px;
        display: none;
        background-color: #f8fafc;
    }
    .task-list{
        padding-left: 10px;
        li{
            list-style: none;
        }
    }
    .task-body{
        padding: 10px;
    }
    .task-text{
        margin: 5px 0;
    }
    .task-footer{
        padding: 5px 10px 5px 20px;
        border-top: solid 1px #3d91cd;
    }
    .contributor-profile{
        width: 30px;
        height: 30px;
        border-radius: 50%;
        font-size: 12px;
        line-height: 2.2;
        border: solid 2px tomato;
        text-align: center;
        margin-left: -8px;
        background-color: #fff;;
    }
    .contributor-profile:first-child{
        border: solid 2px green;
    }
    .user-profile{
        display: flex;
        -ms-align-items: center;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-weight: bold;
        width: 80px;
        height: 80px;
        cursor: pointer;
        /*background: url(./piblic/img/profile.png) no-repeat center / contain;*/
    }
    .left-menu{
        li{
            list-style: none;
            border-bottom: solid 1px #3d91cd;
            line-height: 2;
            cursor: pointer;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            padding-right: 5px;
            align-items: center;
            &:hover{
                background-color: #dfe0e2;
                & > i{
                    display: block;
                }
            }
            & > i{
                display: none;
                transition: .3s;
            }
            &.active{
                background-color: #2196F3;
                color: #fff;
            }
            & > i:hover{
                font-size: 20px;
            }
        }
    }
    .profile-option{
        line-height: 1.3;
        li{
            list-style: none;
            width: 100%;
            cursor: pointer;
            transition: .3s;
            padding: 0 5px;
            &:hover{
                background-color: #dfe0e2;
            }
        }
    }
    .board-contributors{
        font-size: 16px;
    }
    .element-outline-primary{
        border: solid 1px #3490dc;
        padding: 0 5px;
        border-radius: 5px;
        cursor: pointer;
        transition: .3s;
        &:hover{
            background: #3490dc;
            color: #fff;
        }
    }
</style>
