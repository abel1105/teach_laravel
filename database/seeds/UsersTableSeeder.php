<?php


use App\Teach\User\Constant\PermissionConstant;
use App\Teach\User\Constant\RoleConstant;
use App\Teach\User\Entity\Permission;
use App\Teach\User\Entity\Role;
use App\Teach\User\Entity\User;

class UsersTableSeeder extends \Illuminate\Database\Seeder
{
    protected $Abel;
    protected $Author;
    protected $Editor;

    protected $AdminRole;
    protected $AuthorRole;
    protected $EditorRole;

    protected $CreateUserPermission;
//    protected $CreateArticlePermission;
//    protected $ReadArticlePermission;
//    protected $UpdateArticlePermission;
    protected $DeleteArticlePermission;
    protected $PublishArticlePermission;

    public function run()
    {
        $this->addUser();
        $this->addRole();
        $this->addPermission();
        $this->addRolePermission();
        $this->addUserRole();
    }

    protected function addUser()
    {
        # 新增 ABEL
        $User = new User();
        $User->name = 'abel';
        $User->email = 'kent62001@gmail.com';
        $User->password = Hash::make('123');
        $User->save();
        $this->Abel = $User;
        # 新增作者
        $User = new User();
        $User->name = 'author';
        $User->email = 'author@gmail.com';
        $User->password = Hash::make('123');
        $User->save();
        $this->Author = $User;
        # 新增編輯
        $User = new User();
        $User->name = 'editor';
        $User->email = 'editor@gmail.com';
        $User->password = Hash::make('123');
        $User->save();
        $this->Editor = $User;
    }

    protected function addRole()
    {
        $Role = new Role();
        $Role->name = RoleConstant::ADMIN_ROLE_NAME;
        $Role->display_name = '管理員';
        $Role->description = '系統admin';
        $Role->save();
        $this->AdminRole = $Role;

        $Role = new Role();
        $Role->name = RoleConstant::AUTHOR_ROLE_NAME;
        $Role->display_name = '作者';
        $Role->description = '作者';
        $Role->save();
        $this->AuthorRole = $Role;

        $Role = new Role();
        $Role->name = RoleConstant::EDITOR_ROLE_NAME;
        $Role->display_name = '編輯';
        $Role->description = '編輯';
        $Role->save();
        $this->EditorRole = $Role;
    }

    protected function addPermission()
    {
        $Permission = new Permission();
        $Permission->name = PermissionConstant::CREATE_USER_PERMISSION;
        $Permission->display_name = '新增使用者';
        $Permission->description = '新增使用者';
        $Permission->save();
        $this->CreateUserPermission = $Permission;

//        $Permission = new Permission();
//        $Permission->name = PermissionConstant::CREATE_ARTICLE_PERMISSION;
//        $Permission->display_name = '新增文章';
//        $Permission->description = '新增文章';
//        $Permission->save();
//        $this->CreateArticlePermission = $Permission;
//
//        $Permission = new Permission();
//        $Permission->name = PermissionConstant::READ_ARTICLE_PERMISSION;
//        $Permission->display_name = '閱讀文章';
//        $Permission->description = '閱讀文章';
//        $Permission->save();
//        $this->ReadArticlePermission = $Permission;
//
//        $Permission = new Permission();
//        $Permission->name = PermissionConstant::UPDATE_ARTICLE_PERMISSION;
//        $Permission->display_name = '修改文章';
//        $Permission->description = '修改文章';
//        $Permission->save();
//        $this->UpdateArticlePermission = $Permission;

        $Permission = new Permission();
        $Permission->name = PermissionConstant::DELETE_ARTICLE_PERMISSION;
        $Permission->display_name = '刪除文章';
        $Permission->description = '刪除文章';
        $Permission->save();
        $this->DeleteArticlePermission = $Permission;

        $Permission = new Permission();
        $Permission->name = PermissionConstant::PUBLISH_ARTICLE_PERMISSION;
        $Permission->display_name = '發布文章';
        $Permission->description = '發布文章';
        $Permission->save();
        $this->PublishArticlePermission = $Permission;
    }

    protected function addRolePermission()
    {
        $this->AdminRole->attachPermission($this->CreateUserPermission);
//        $this->AdminRole->attachPermission($this->CreateArticlePermission);
//        $this->AdminRole->attachPermission($this->ReadArticlePermission);
//        $this->AdminRole->attachPermission($this->UpdateArticlePermission);
        $this->AdminRole->attachPermission($this->DeleteArticlePermission);
        $this->AdminRole->attachPermission($this->PublishArticlePermission);

//        $this->AuthorRole->attachPermission($this->CreateArticlePermission);
//        $this->AuthorRole->attachPermission($this->ReadArticlePermission);
//        $this->AuthorRole->attachPermission($this->UpdateArticlePermission);
//        $this->AdminRole->attachPermission($this->PublishArticlePermission);

//        $this->EditorRole->attachPermission($this->CreateArticlePermission);
//        $this->EditorRole->attachPermission($this->ReadArticlePermission);
//        $this->EditorRole->attachPermission($this->UpdateArticlePermission);
        $this->EditorRole->attachPermission($this->DeleteArticlePermission);
        $this->EditorRole->attachPermission($this->PublishArticlePermission);
    }

    protected function addUserRole()
    {
        $this->Abel->attachRole($this->AdminRole);
        $this->Author->attachRole($this->AuthorRole);
        $this->Editor->attachRole($this->EditorRole);
    }

}