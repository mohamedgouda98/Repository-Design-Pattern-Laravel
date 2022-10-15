<?php

namespace Unlimited\Repository\Console\Traits;

trait ProviderHelper
{
    public function updateProviderFile($interfaceName, $repositoryName)
    {
        $sourceFile =  __DIR__ . "/../../RepositoryServiceProvider.php";
        $copyPath =  __DIR__ . "/../../";

        $contents = file_get_contents($sourceFile);
        $newBind = $this->getProviderBind($interfaceName, $repositoryName);

        $new_contents = str_replace('//Bind', $newBind, $contents);

        $this->files->put($copyPath . 'RepositoryServiceProvider.php', $new_contents);

        $this->info('Provider Class was successfully Updated.');
    }

    public function getProviderBind($interfaceName, $repositoryName)
    {
        $bindSourceFile =  __DIR__ . "/../../stubs/ProviderBind.php.stub";
        $contentsBind = file_get_contents($bindSourceFile);

        $newBind = str_replace('RepositoryInterface', $interfaceName, $contentsBind);
        $newBind = str_replace('RepositoryClass', $repositoryName, $newBind);
        return $newBind;
    }

}