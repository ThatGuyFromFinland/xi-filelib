<?php

/**
 * This file is part of the Xi Filelib package.
 *
 * For copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xi\Filelib;

class Events
{
    const FILE_UPLOAD = 'xi_filelib.file.upload';
    const FILE_BEFORE_CREATE = 'xi_filelib.file.before_create';
    const FILE_AFTER_CREATE = 'xi_filelib.file.after_create';
    const FILE_BEFORE_DELETE = 'xi_filelib.file.before_delete';
    const FILE_AFTER_DELETE = 'xi_filelib.file.after_delete';
    const FILE_BEFORE_COPY = 'xi_filelib.file.before_copy';
    const FILE_AFTER_COPY = 'xi_filelib.file.after_copy';
    const FILE_BEFORE_UPDATE = 'xi_filelib.file.before_update';
    const FILE_AFTER_UPDATE = 'xi_filelib.file.after_update';
    const FILE_AFTER_AFTERUPLOAD = 'xi_filelib.file.after_upload';

    const RESOURCE_BEFORE_DELETE = 'xi_filelib.resource.before_delete';
    const RESOURCE_AFTER_DELETE = 'xi_filelib.resource.after_delete';
    const RESOURCE_BEFORE_CREATE = 'xi_filelib.resource.before_create';
    const RESOURCE_AFTER_CREATE = 'xi_filelib.resource.after_create';
    const RESOURCE_BEFORE_UPDATE = 'xi_filelib.resource.before_update';
    const RESOURCE_AFTER_UPDATE = 'xi_filelib.resource.after_update';

    const FOLDER_BEFORE_WRITE_TO = 'xi_filelib.folder.before_write_to';

    const FOLDER_BEFORE_DELETE = 'xi_filelib.folder.before_delete';
    const FOLDER_AFTER_DELETE = 'xi_filelib.folder.after_delete';

    const FOLDER_BEFORE_CREATE = 'xi_filelib.folder.before_create';
    const FOLDER_AFTER_CREATE = 'xi_filelib.folder.after_create';

    const FOLDER_BEFORE_UPDATE = 'xi_filelib.folder.before_update';
    const FOLDER_AFTER_UPDATE = 'xi_filelib.folder.after_update';

    const PROFILE_AFTER_ADD = 'xi_filelib.profile.after_add';

    const PLUGIN_AFTER_ADD = 'xi_filelib.plugin.after_add';

    const IDENTITYMAP_AFTER_ADD = 'xi_filelib.identitymap.after_add';
    const IDENTITYMAP_BEFORE_ADD = 'xi_filelib.identitymap.before_add';
    const IDENTITYMAP_AFTER_REMOVE = 'xi_filelib.identitymap.after_remove';
    const IDENTITYMAP_BEFORE_REMOVE = 'xi_filelib.identitymap.before_remove';

    const IDENTIFIABLE_INSTANTIATE = 'xi_filelib.identifiable.instantiate';
}
