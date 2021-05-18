<?php

require_once("../classes/Folder.class.php");
require_once("../classes/File.class.php");
require_once("../classes/FileSystem.class.php");

# Create a set of files
create_file_group("very_cute\\");

# Rename the default set of files
//rename_file_group("cute\\");

# Delete the whole file group
//delete_file_group("cute\\");

# Update the size and modification time of the file group
update_file_group("cute\\");

# Get all information about this new directory (size, number of files etc.)
$dir = instantiate_dir("..\\cat_storage\\", "");
$fileSystem = new FileSystem();
get_directory_information($dir, $fileSystem);

# Rename the directory
$dir->setName("cute\\");
$fileSystem->renameDirectory($dir, "\\super_cute\\");

/**
 * Create an instance of a file
 *
 * @param Folder $directory The path to the file
 * @param string $name The name of the file
 * @return File
 */
function instantiate_file(Folder $directory, string $name)
{
    $file = new File();
    $file->setParentDirectory($directory);
    $file->setName($name);
    return $file;
}

/**
 * Save the file into a new directory.
 *
 * @param string $location Name a directory to save the file into
 */
function create_file_group(string $location)
{
    $dir = instantiate_dir("..\\", "images\\");
    $saveTo = instantiate_dir("..\\cat_storage\\", $location);
    $fileSystem = new FileSystem();
    $file = instantiate_file($dir, "cat_1.gif");
    $fileSystem->createFile($file, $saveTo);
    $file = instantiate_file($dir, "cat_2.gif");
    $fileSystem->createFile($file, $saveTo);
    $file = instantiate_file($dir, "cat_3.gif");
    $fileSystem->createFile($file, $saveTo);
}

/**
 * Rename all of the files in a given directory.
 *
 * @param string $location The name of the files' directory
 */
function rename_file_group(string $location)
{
    $dir = instantiate_dir("..\\cat_storage\\", $location);
    $file = instantiate_file($dir, "cat_1.gif");
    $fileSystem = new FileSystem();
    $fileSystem->renameFile($file, "cute.gif");
    $file = instantiate_file($dir, "cat_2.gif");
    $fileSystem->renameFile($file, "sweetie.gif");
    $file = instantiate_file($dir, "cat_3.gif");
    $fileSystem->renameFile($file, "adorable.gif");
}

/**
 * Delete a directory and the files contained within.
 *
 * @param string $location The location of files to be deleted
 */
function delete_file_group(string $location)
{
    $dir = instantiate_dir("..\\cat_storage\\", $location);
    $fileSystem = new FileSystem();
    $fileSystem->deleteDirectory($dir);
}

/**
 * Update the size and modification time of all files in a folder.
 *
 * @param string $location The files to be updated
 */
function update_file_group(string $location)
{
    $dir = instantiate_dir("..\\cat_storage\\", $location);
    $file = instantiate_file($dir, "cat_1.gif");
    $file->setModifiedTime(new DateTime());
    $file->setSize(200);
    $fileSystem = new FileSystem();
    $fileSystem->updateFile($file);
    $file = instantiate_file($dir, "cat_2.gif");
    $file->setModifiedTime(new DateTime());
    $file->setSize(200);
    $fileSystem->updateFile($file);
    $file = instantiate_file($dir, "cat_2.gif");
    $file->setModifiedTime(new DateTime());
    $file->setSize(200);
    $fileSystem->updateFile($file);
}

/**
 * Create an instance of a directory.
 *
 * @param string $basePath The path to the directory.
 * @param string $name The name of the last directory in the path.
 * @return Folder
 */
function instantiate_dir(string $basePath, string $name)
{
    $directory = new Folder();
    $directory->setPath($basePath);
    $directory->setName($name);
    return $directory;
}

/**
 * Gets all of the information about a given directory
 * - Number of dirs
 * - Number of files
 * - Storage size of dir
 * - The names of all dirs
 * - The names of all files
 *
 * @param Folder $directory The directory to gather information on.
 * @param FileSystem $fileSystem The system which will gather all of the information.
 */
function get_directory_information(Folder $directory, FileSystem $fileSystem)
{
    echo "Total Number of sub directories:\n";
    echo $fileSystem->getDirectoryCount($directory) . "\n\n";
    echo "Total number of files in current directory and all sub-directories:\n";
    echo $fileSystem->getFileCount($directory) . "\n\n";
    echo "Get the storage size of the directory:\n";
    echo $fileSystem->getDirectorySize($directory) . "\n\n";
    echo "List all of the directories and sub-directories:\n";
    print_r($fileSystem->getDirectories($directory));
    echo "List all of the files in this directory and its sub-directories:\n";
    print_r($fileSystem->getFiles($directory));
}