async function loadMayBeLikeProducts() {
  try {
    // Gọi API để lấy dữ liệu sản phẩm
    const response = await fetch('./api/mayBeLikeProducts.php')
    const products = await response.json()

    // Lấy phần tử chứa các sản phẩm
    const mayBeLikeContent = document.getElementById('mayBeLikeContent')

    // Duyệt qua từng sản phẩm và thêm vào HTML
    products.forEach((product) => {
      const listItem = document.createElement('li')
      listItem.classList.add(
        'itemA',
        'list-none',
        'p-2',
        'border',
        'rounded',
        'shadow-md',
        'relative',
        'hover:shadow'
      )

      listItem.innerHTML = `
                <a href="http://localhost/ThaiLinhStore/?quanly=productDetails&id=${
                  product.id
                }">
                    <img src="${product.thumbnail}" alt="This is a image" />
                    <p>${product.model}</p>
                    <p>${product.price} ₫</p>
                    <span class="text-sm line-through" ${
                      product.discount > 0 ? '' : 'hidden'
                    }>${product.originalPrice} ₫</span>
                    <span class="text-xs font-semibold" ${
                      product.discount > 0 ? '' : 'hidden'
                    }>Giảm ${product.discount}%</span>
                    <div class="divHidden absolute opacity-75">
                        <a href="pages/cart/workWithCart.php?id=${product.id}">
                            <p>Thêm giỏ hàng</p>
                        </a>
                    </div>
                </a>
            `

      // Thêm sản phẩm vào phần tử chứa sản phẩm
      mayBeLikeContent.appendChild(listItem)
    })
  } catch (error) {
    console.error('Error loading products:', error)
  }
}

async function loadAppleAuthProducts() {
  try {
    // Gọi API để lấy dữ liệu sản phẩm
    const response = await fetch('./api/appleAuthProducts.php')
    const products = await response.json()

    // Lấy phần tử chứa các sản phẩm
    const mayBeLikeContent = document.getElementById('appleAuthContent')

    // Duyệt qua từng sản phẩm và thêm vào HTML
    products.forEach((product) => {
      const listItem = document.createElement('li')
      listItem.classList.add(
        'itemA',
        'list-none',
        'p-2',
        'border',
        'rounded',
        'shadow-md',
        'relative',
        'hover:shadow'
      )

      listItem.innerHTML = `
                  <a href="http://localhost/ThaiLinhStore/?quanly=productDetails&id=${
                    product.id
                  }">
                      <img src="${product.thumbnail}" alt="This is a image" />
                      <p>${product.model}</p>
                      <p>${product.price} ₫</p>
                      <span class="text-sm line-through" ${
                        product.discount > 0 ? '' : 'hidden'
                      }>${product.originalPrice} ₫</span>
                      <span class="text-xs font-semibold" ${
                        product.discount > 0 ? '' : 'hidden'
                      }>Giảm ${product.discount}%</span>
                      <div class="divHidden absolute opacity-75">
                          <a href="pages/cart/workWithCart.php?id=${
                            product.id
                          }">
                              <p>Thêm giỏ hàng</p>
                          </a>
                      </div>
                  </a>
              `

      // Thêm sản phẩm vào phần tử chứa sản phẩm
      mayBeLikeContent.appendChild(listItem)
    })
  } catch (error) {
    console.error('Error loading products:', error)
  }
}

async function loadProminentPhones() {
  try {
    // Gọi API để lấy dữ liệu sản phẩm
    const response = await fetch('./api/prominentPhones.php')
    const products = await response.json()

    // Lấy phần tử chứa các sản phẩm
    const mayBeLikeContent = document.getElementById('prominentPhonesContent')

    // Duyệt qua từng sản phẩm và thêm vào HTML
    products.forEach((product) => {
      const listItem = document.createElement('li')
      listItem.classList.add(
        'itemA',
        'list-none',
        'p-2',
        'border',
        'rounded',
        'shadow-md',
        'relative',
        'hover:shadow'
      )

      listItem.innerHTML = `
                    <a href="http://localhost/ThaiLinhStore/?quanly=productDetails&id=${
                      product.id
                    }">
                        <img src="${product.thumbnail}" alt="This is a image" />
                        <p>${product.model}</p>
                        <p>${product.price} ₫</p>
                        <span class="text-sm line-through" ${
                          product.discount > 0 ? '' : 'hidden'
                        }>${product.originalPrice} ₫</span>
                        <span class="text-xs font-semibold" ${
                          product.discount > 0 ? '' : 'hidden'
                        }>Giảm ${product.discount}%</span>
                        <div class="divHidden absolute opacity-75">
                            <a href="pages/cart/workWithCart.php?id=${
                              product.id
                            }">
                                <p>Thêm giỏ hàng</p>
                            </a>
                        </div>
                    </a>
                `

      // Thêm sản phẩm vào phần tử chứa sản phẩm
      mayBeLikeContent.appendChild(listItem)
    })
  } catch (error) {
    console.error('Error loading products:', error)
  }
}

async function loadProminentSpeakersHeadphones() {
  try {
    // Gọi API để lấy dữ liệu sản phẩm
    const response = await fetch('./api/prominentSpeakersHeadphones.php')
    const products = await response.json()

    // Lấy phần tử chứa các sản phẩm
    const mayBeLikeContent = document.getElementById(
      'prominentSpeakersHeadphonesContent'
    )

    // Duyệt qua từng sản phẩm và thêm vào HTML
    products.forEach((product) => {
      const listItem = document.createElement('li')
      listItem.classList.add(
        'itemA',
        'list-none',
        'p-2',
        'border',
        'rounded',
        'shadow-md',
        'relative',
        'hover:shadow'
      )

      listItem.innerHTML = `
                      <a href="http://localhost/ThaiLinhStore/?quanly=productDetails&id=${
                        product.id
                      }">
                          <img src="${
                            product.thumbnail
                          }" alt="This is a image" />
                          <p>${product.model}</p>
                          <p>${product.price} ₫</p>
                          <span class="text-sm line-through" ${
                            product.discount > 0 ? '' : 'hidden'
                          }>${product.originalPrice} ₫</span>
                          <span class="text-xs font-semibold" ${
                            product.discount > 0 ? '' : 'hidden'
                          }>Giảm ${product.discount}%</span>
                          <div class="divHidden absolute opacity-75">
                              <a href="pages/cart/workWithCart.php?id=${
                                product.id
                              }">
                                  <p>Thêm giỏ hàng</p>
                              </a>
                          </div>
                      </a>
                  `

      // Thêm sản phẩm vào phần tử chứa sản phẩm
      mayBeLikeContent.appendChild(listItem)
    })
  } catch (error) {
    console.error('Error loading products:', error)
  }
}

async function loadIPhoneBatteryReplacementAndRepair() {
    try {
      // Gọi API để lấy dữ liệu sản phẩm
      const response = await fetch('./api/iPhoneBatteryReplacementAndRepair.php')
      const products = await response.json()
  
      // Lấy phần tử chứa các sản phẩm
      const mayBeLikeContent = document.getElementById(
        'iPhoneBatteryReplacementAndRepairContent'
      )
  
      // Duyệt qua từng sản phẩm và thêm vào HTML
      products.forEach((product) => {
        const listItem = document.createElement('li')
        listItem.classList.add(
          'itemA',
          'list-none',
          'p-2',
          'border',
          'rounded',
          'shadow-md',
          'relative',
          'hover:shadow'
        )
  
        listItem.innerHTML = `
                        <a href="http://localhost/ThaiLinhStore/?quanly=productDetails&id=${
                          product.id
                        }">
                            <img src="${
                              product.thumbnail
                            }" alt="This is a image" />
                            <p>${product.model}</p>
                            <p>${product.price} ₫</p>
                            <span class="text-sm line-through" ${
                              product.discount > 0 ? '' : 'hidden'
                            }>${product.originalPrice} ₫</span>
                            <span class="text-xs font-semibold" ${
                              product.discount > 0 ? '' : 'hidden'
                            }>Giảm ${product.discount}%</span>
                            <div class="divHidden absolute opacity-75">
                                <a href="pages/cart/workWithCart.php?id=${
                                  product.id
                                }">
                                    <p>Thêm giỏ hàng</p>
                                </a>
                            </div>
                        </a>
                    `
  
        // Thêm sản phẩm vào phần tử chứa sản phẩm
        mayBeLikeContent.appendChild(listItem)
      })
    } catch (error) {
      console.error('Error loading products:', error)
    }
  }

function loadHome() {
  loadMayBeLikeProducts()
  loadAppleAuthProducts()
  loadProminentPhones()
  loadProminentSpeakersHeadphones()
  loadIPhoneBatteryReplacementAndRepair()
}

document.addEventListener('DOMContentLoaded', loadHome)
