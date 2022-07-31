import request from '@/services/request';

export const getOrders = () => {
    return request({
        url: 'all/orders',
        method: 'get'
    })
}

export const makePayment = (parameter) => {
    return request({
        url: 'make/payment',
        method: 'post',
        data: parameter
    })
}