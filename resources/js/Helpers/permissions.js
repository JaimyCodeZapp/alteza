export const hasPermission = (permissionName, permissionsList) => {
    return permissionsList.some(
        (permission) => permission.name === permissionName
    );
};
