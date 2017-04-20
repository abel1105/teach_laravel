<?php


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
    protected $CreateArticlePermission;
    protected $ReadArticlePermission;
    protected $UpdateArticlePermission;
    protected $DeleteArticlePermission;

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
        $Role->name = 'admin';
        $Role->display_name = '管理員';
        $Role->description = '系統admin';
        $Role->save();
        $this->AdminRole = $Role;

        $Role = new Role();
        $Role->name = 'author';
        $Role->display_name = '作者';
        $Role->description = '作者';
        $Role->save();
        $this->AuthorRole = $Role;

        $Role = new Role();
        $Role->name = 'editor';
        $Role->display_name = '編輯';
        $Role->description = '編輯';
        $Role->save();
        $this->EditorRole = $Role;
    }

    protected function addPermission()
    {
        $Permission = new Permission();
        $Permission->name = 'create.user';
        $Permission->display_name = '新增使用者';
        $Permission->description = '新增使用者';
        $Permission->save();
        $this->CreateUserPermission = $Permission;

        $Permission = new Permission();
        $Permission->name = 'create.article';
        $Permission->display_name = '新增文章';
        $Permission->description = '新增文章';
        $Permission->save();
        $this->CreateArticlePermission = $Permission;

        $Permission = new Permission();
        $Permission->name = 'read.article';
        $Permission->display_name = '閱讀文章';
        $Permission->description = '閱讀文章';
        $Permission->save();
        $this->ReadArticlePermission = $Permission;

        $Permission = new Permission();
        $Permission->name = 'update.article';
        $Permission->display_name = '修改文章';
        $Permission->description = '修改文章';
        $Permission->save();
        $this->UpdateArticlePermission = $Permission;

        $Permission = new Permission();
        $Permission->name = 'delete.article';
        $Permission->display_name = '刪除文章';
        $Permission->description = '刪除文章';
        $Permission->save();
        $this->DeleteArticlePermission = $Permission;
    }

    protected function addRolePermission()
    {
        $this->AdminRole->attachPermission($this->CreateUserPermission);
        $this->AdminRole->attachPermission($this->CreateArticlePermission);
        $this->AdminRole->attachPermission($this->ReadArticlePermission);
        $this->AdminRole->attachPermission($this->UpdateArticlePermission);
        $this->AdminRole->attachPermission($this->DeleteArticlePermission);

        $this->AuthorRole->attachPermission($this->CreateArticlePermission);
        $this->AuthorRole->attachPermission($this->ReadArticlePermission);
        $this->AuthorRole->attachPermission($this->UpdateArticlePermission);

        $this->EditorRole->attachPermission($this->CreateArticlePermission);
        $this->EditorRole->attachPermission($this->ReadArticlePermission);
        $this->EditorRole->attachPermission($this->UpdateArticlePermission);
        $this->EditorRole->attachPermission($this->DeleteArticlePermission);

    }

    protected function addUserRole()
    {
        $this->Abel->attachRole($this->AdminRole);
        $this->Author->attachRole($this->AuthorRole);
        $this->Editor->attachRole($this->EditorRole);
    }

}