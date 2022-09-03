import request from '@/services/request';

export const getUsers = () => {
    return request({
        url: 'all/users',
        method: 'get'
    })
}