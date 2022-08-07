import request from '@/services/request';

export const getProducts = () => {
    return request({
        url: 'product',
        method: 'get'
    })
}