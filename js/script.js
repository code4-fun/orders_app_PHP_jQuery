$(document).ready(function (){
  // Open popup
  $('.comment-button').on('click', function (event){
    $('.popup-inner')
      .on('click', function (event){
        event.stopPropagation()
      })
    $('.popup-outer')
      .addClass('active')
      .on('click', function () {
        $(this).removeClass('active')
        removeFormValues()
      })
  })
})

// Create order
function createOrder(data){
  clearErrors()

  const initialDate = data.get('date')
  const date = new Date(data.get('date'))
  const date_ = date.getFullYear() + '/' + date.getMonth() + '/' + date.getDate()
  const clientId = data.get('client')
  const clientName = $('#select-client option:selected').text()
  const description = data.get('description')
  const paid = !!data.get('paid') ? 1 : 0
  const initialSum = data.get('sum')
  const sum = parseFloat(initialSum)
  if(initialDate === '' || clientId == null || description === '' || initialSum === ''){
    $('.popup-errors').append('<div>fill in all values</div>')
    return
  }
  if(isNaN(sum)){
    $('.popup-errors').append('<div>incorrect number</div>')
    return
  }

  $.ajax({
    url: "create.php",
    type: 'POST',
    data: {
      date: initialDate,
      clientId: clientId,
      description: description,
      sum: parseFloat(data.get('sum')),
      paid: paid
    },
    success: (id) => {
      if(id){
        $('.orderList').prepend(listItem(id, date_, clientName, sum, paid))
        removeFormValues()
      }
    },
    error: (e) => {
      console.log(e)
    }
  })
  $('.popup-outer').removeClass('active')
  removeFormValues()
}

// Delete order and remove it from the list
function deleteOrder(id){
  $.ajax({
    url: "delete.php",
    type: 'POST',
    data: {
      id: id
    },
    success: (data) => {
      if(data){
        $('#order_' + id).hide('slow')
      }
    },
    error: (e) => {
      console.log(e)
    }
  })
}

// Remove errors in popup form
function clearErrors(){
  $('.popup-errors').children().remove()
}

// Clear form
function removeFormValues(){
  $('.popup-input').val('')
  $('#select-client').val('default')
  $('.popup-checkbox').prop('checked', false)
  clearErrors()
}

// Order list item to append after ajax query
function listItem(id, date, clientName, sum, paid){
  const paidClass = paid ? 'orderItem__text--paid' : 'orderItem__text--unpaid'

  return `      <div class=\'orderItem\' id="order_${id}">\n` +
    `            <a href="order.php?id=${id}"\n` +
    '               class="orderItem__link">\n' +
    '              <div class=\'orderItem__body\'>\n' +
    '                <div class=\'orderItem__content\'>\n' +
    `                 <div class=\'orderItem__text\'>${date}</div>\n` +
    `                  <div class=\'orderItem__text\'>${clientName}</div>\n` +
    `                  <div class=\'orderItem__text ${paidClass} \'>${sum}</div>\n` +
    '                </div>\n' +
    '              </div>\n' +
    '            </a>\n' +
    '            <div class="orderItem__delete">\n' +
    `              <form method="post" onsubmit="event.preventDefault(); deleteOrder(${id});">\n` +
    '                <input type="image"\n' +
    '                       src=\'img/trash.svg\'\n' +
    '                       class="orderItem__delete--input">\n' +
    '              </form>\n' +
    '            </div>' +
    '          </div>'
}