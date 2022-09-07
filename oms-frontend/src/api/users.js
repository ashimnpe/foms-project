import request from '@/services/request';

export const getUsers = () => {
    return request({
        url: 'all/users',
        method: 'get'
    })
}

export const createUser = (params) => {
    return request({
        url: 'user',
        method: 'post',
        data: params
    })
}

export const updateUser = (params) => {
    return request({
        url: 'update/user',
        method: 'post',
        data: params
    })
}

export const deleteUser = (params) => {
    return request({
        url: 'delete/user',
        method: 'post',
        data: params
    })
}