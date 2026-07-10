const btnBuy = document.querySelectorAll('.btn-buy')
const refreshProd = document.querySelectorAll('.refresh-prod')
const toCart = document.querySelectorAll('.btn-to-card')
const prodCounts = document.querySelectorAll('.count-prod')
const singleFizProduct = document.querySelector('.single-fiz-product')

const card = document.querySelectorAll('.prod-container')


let forAsync = []

const getSavedOrder = () => {
    try {
        return JSON.parse(localStorage.getItem('order')) || []
    } catch (error) {
        return []
    }
}

const normalizeCount = (value) => {
    const count = parseInt(value, 10)

    return count > 0 ? count : 1
}

const addProductToOrder = (productId, count) => {
    const productInfo = fizProductArray.find((arrayItem) => productId === arrayItem.id)

    if (!productInfo) {
        return null
    }

    let update = false
    const normalizedCount = normalizeCount(count)
    const productForOrder = {...productInfo, count: normalizedCount}

    if (forAsync.length !== 0) {
        forAsync = forAsync.map(item => {
            if(productForOrder.id === item.id) {
                update = true

                return {...item, count: productForOrder.count + item.count}
            }

            return item
        })

        if (!update) {
            forAsync.push(productForOrder)
        }
    } else {
        forAsync.push(productForOrder)
    }

    saveOrder();

    return productForOrder
}

const saveOrder = () => {
    if (forAsync.length) {
        localStorage.setItem("order", JSON.stringify(forAsync));
    } else {
        localStorage.removeItem("order");
    }

    setCartCount(forAsync);
}


const createCardBasketBlock = (count = 1) => {
    const inBasketP = document.createElement('span')
    inBasketP.classList.add('in-basket-p')
    inBasketP.innerHTML = `
        <span class="in-basket-p__label">В корзине</span>
        <span class="in-basket-p__controls" aria-label="Управление количеством товара в корзине">
            <button type="button" class="in-basket-p__button in-basket-p__minus" aria-label="Уменьшить количество">−</button>
            <span class="in-basket-p__count"><span class="in-basket-span">${count}</span> шт.</span>
            <button type="button" class="in-basket-p__button in-basket-p__plus" aria-label="Увеличить количество">+</button>
        </span>
        <button type="button" class="in-basket-p__clear">Очистить</button>
    `

    return inBasketP
}

const getCardBasketBlock = (cardItem, count = 1) => {
    let inBasketP = cardItem.querySelector('.in-basket-p')

    if (!inBasketP) {
        inBasketP = createCardBasketBlock(count)
        const addToCardBox = cardItem.querySelector('.add-to-card-box')

        if (addToCardBox) {
            addToCardBox.insertAdjacentElement('beforebegin', inBasketP)
        }
    }

    return inBasketP
}

const getProductCard = (productId) => {
    return Array.from(card).find(item => {
        const product = item.querySelector('.product-item')

        return product && product.getAttribute('id') === productId
    })
}

const getProductOrderItem = (productId) => forAsync.find(item => item.id === productId)

const setProductCardState = (productId) => {
    const cardItem = getProductCard(productId)

    if (!cardItem) {
        return
    }

    const orderItem = getProductOrderItem(productId)
    const addToBasket = cardItem.querySelector('.btn-buy')
    const addToCardBox = cardItem.querySelector('.add-to-card-box')
    const countInput = cardItem.querySelector('.add-to-card-input')

    if (orderItem) {
        const inBasketP = getCardBasketBlock(cardItem, orderItem.count)
        const inBasketSpan = inBasketP.querySelector('.in-basket-span')

        addToBasket?.classList.add('none');
        addToCardBox?.classList.add('none');
        inBasketP.classList.remove('none');

        if (inBasketSpan) {
            inBasketSpan.textContent = orderItem.count
        }
    } else {
        const inBasketP = cardItem.querySelector('.in-basket-p')

        addToBasket?.classList.remove('none');
        addToCardBox?.classList.add('none');
        inBasketP?.remove();

        if (countInput) {
            countInput.value = 1
        }
    }
}

const changeProductCount = (productId, count) => {
    const normalizedCount = parseInt(count, 10)

    if (normalizedCount <= 0) {
        forAsync = forAsync.filter(item => item.id !== productId)
    } else {
        forAsync = forAsync.map(item => {
            if (item.id === productId) {
                return {...item, count: normalizedCount}
            }

            return item
        })
    }

    saveOrder();
    setProductCardState(productId);
    setSingleProductState(forAsync);
}

const setFeatures = () => {
    const data = getSavedOrder()
    forAsync = data;
    setCartCount(forAsync);

    if(data.length ) {
        setCard(forAsync)
        setSingleProductState(forAsync)
    }

}

const onBuyClick = () => {
    btnBuy.forEach((buyItem) => {
        buyItem.addEventListener('click', (event) => {
 
            const product = event.target.closest('.product-item')
            
            const addToCardBox = product.querySelector('.add-to-card-box');
            const buyBtn = product.querySelector('.btn-buy');

            buyBtn.classList.add('none')
            addToCardBox.classList.remove('none')
        })
    })
}

const onRefresh = () => {
    refreshProd.forEach((refreshItem) => {
        refreshItem.addEventListener('click', (event) => {
           
            const product = event.target.closest('.product-item')
            
            const addToCardBox = product.querySelector('.add-to-card-box');
            const buyBtn = product.querySelector('.btn-buy');
            const countInput = product.querySelector('.add-to-card-input');
            

            addToCardBox.classList.add('none')
            buyBtn.classList.remove('none')
            countInput.value = 1
        })
    })
}

const onToCart = () => {
    toCart.forEach(btn => {
        btn.addEventListener('click', (event) => {
            const product = event.target.closest('.product-item')
            const productId = product.getAttribute('id');
            const countInput = product.querySelector('.add-to-card-input')
            const count = normalizeCount(countInput.value)

            const productForOrder = addProductToOrder(productId, count)

            if (!productForOrder) {
                return
            }

            setProductCardState(productForOrder.id)
            countInput.value = 1
            
        })
    })
}

const setCartCount = (products) => {
    if (!prodCounts.length) {
        return
    }

    let count = 0;
    products.forEach(prod => {
        count = count + prod.count
    })

    prodCounts.forEach(prodCount => {
        prodCount.textContent = count
    })
}

const setCard = (order) => {
    card.forEach(item => {
        const cardId = item.querySelector('.product-item').getAttribute('id')
        order.forEach(itemOrder => {
            if(cardId === itemOrder.id) {
                setProductCardState(itemOrder.id)
            }
        })

    })
}

const getSingleProductBasketText = () => {
    let inBasketText = singleFizProduct.querySelector('.in-basket-p')

    if (!inBasketText) {
        inBasketText = document.createElement('span')
        inBasketText.classList.add('in-basket-p', 'none')
        inBasketText.innerHTML = 'В корзине <span class="in-basket-span">1</span> шт.'
        singleFizProduct.querySelector('.btn-wishlist').insertAdjacentElement('afterend', inBasketText)
    }

    return inBasketText
}

const setSingleProductState = (order) => {
    if (!singleFizProduct) {
        return
    }

    const productId = singleFizProduct.dataset.productId
    const orderItem = order.find(item => item.id === productId)

    if (orderItem) {
        const inBasketText = getSingleProductBasketText()
        inBasketText.querySelector('.in-basket-span').textContent = orderItem.count
        inBasketText.classList.remove('none')
    }
}

const onCardBasketControls = () => {
    card.forEach(cardItem => {
        const product = cardItem.querySelector('.product-item')
        if (!product) {
            return
        }

        cardItem.addEventListener('click', (event) => {
            if (!event.target.closest('.in-basket-p')) {
                return
            }

            const productId = product.getAttribute('id')
            const orderItem = getProductOrderItem(productId)

            if (!orderItem) {
                return
            }

            if (event.target.closest('.in-basket-p__plus')) {
                changeProductCount(productId, Number(orderItem.count) + 1)
            }

            if (event.target.closest('.in-basket-p__minus')) {
                changeProductCount(productId, Number(orderItem.count) - 1)
            }

            if (event.target.closest('.in-basket-p__clear')) {
                changeProductCount(productId, 0)
            }
        })
    })
}

const onSingleProductToCart = () => {
    if (!singleFizProduct) {
        return
    }

    const button = singleFizProduct.querySelector('.btn-wishlist')
    const countInput = singleFizProduct.querySelector('.input-insingle-prod')

    if (!button || !countInput) {
        return
    }

    button.addEventListener('click', (event) => {
        event.preventDefault()

        const count = normalizeCount(countInput.value)
        const productForOrder = addProductToOrder(singleFizProduct.dataset.productId, count)

        if (!productForOrder) {
            return
        }

        const inBasketText = getSingleProductBasketText()
        const orderItem = forAsync.find(item => item.id === productForOrder.id)

        inBasketText.querySelector('.in-basket-span').textContent = orderItem ? orderItem.count : count
        inBasketText.classList.remove('none')
        countInput.value = 1
    })
}



setFeatures();
onBuyClick();
onRefresh();
onToCart();
onCardBasketControls();
onSingleProductToCart();
