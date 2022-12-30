$(document).ready(function (){
  // Open popup for adding order
  $('.create-order-button').on('click', function (event){
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

  // Open popup of burger menu
  $('.header__burger').on('click', function(){
    $('.header__menu--inner')
      .on('click', function (event){
        event.stopPropagation()
      })
    $('.header__menu--outer')
      .addClass('active')
      .on('click', function () {
        $(this).removeClass('active')
      })
  })

  // Close burger popup menu when it is clicked
  $('.header__menu--link').on('click', function(){
    $('.header__menu--outer').removeClass('active')
  })

  // Sets width of the list header to width of the list content on load
  $('.orderItem--header').width($('.orderList .orderItem:first-child').width())
})

// Sets width of the list header to width of the list content on resize
$(window).resize(function() {
  $('.orderItem--header').width($('.orderList .orderItem:first-child').width())
});

// Create order
function createOrder(data){
  clearErrors()
  const initialDate = data.get('date')
  const date = new Date(data.get('date'))
  const date_ = date.getFullYear() + '/' + ('0' + (date.getMonth() + 1)).slice(-2) + '/' + ('0' + date.getDate()).slice(-2)
  const clientId = data.get('client')
  const clientName = $('#select-client option:selected').text()
  const description = data.get('description')
  const paid = !!data.get('paid') ? 1 : 0
  const initialSum = data.get('sum')
  const sum = parseFloat(initialSum)
  if(initialDate === '' || clientId == null || description === '' || initialSum === ''){
    $('.popup-errors').append('<div>Fill in all values</div>')
    return
  }
  if(isNaN(sum)){
    $('.popup-errors').append('<div>Incorrect number</div>')
    return
  }

  let elementId
  let position
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
    beforeSend: function() {
      const result = findInsertPosition(initialDate)
      elementId = '#order_' + result[0]
      position = result[1]
    }
  }).done((id) => {
    if(id){
      position === 'before'
        ? $(elementId).before($(listItem(id, date_, clientName, sum, paid)).hide().delay(200).show('slow'))
        : $(elementId).after($(listItem(id, date_, clientName, sum, paid)).hide().delay(200).show('slow'))
      removeFormValues()
    }
  }).fail(e => {
    console.log(e)
  })
  $('.popup-outer').removeClass('active')
  removeFormValues()
}

// Seeks for the position in the list to insert new order
function findInsertPosition(date){
  let result
  let targetDate = Date.parse(date)
  let list = []
  $('.orderItem:not(.orderItem--header)').each(function(){
    list.push([
      $(this).attr('id').substring(6),
      Date.parse($(this).find('.orderItem__text--date').text().replaceAll('/', '.'))
    ])
  })

  if(list[0][1] <= targetDate){
    return [list[0][0], 'before']
  }

  if(list[list.length - 1][1] > targetDate){
    return [list[list.length - 1][0], 'after']
  }

  let i = list.length - 1
  while(targetDate >= list[i][1]  && i >= 0){
    result = list[i]
    i--
  }
  return [result[0], "before"]
}

// Delete order and remove it from the list
function deleteOrder(id){
  $.ajax({
    url: "delete.php",
    type: 'POST',
    data: {
      id: id
    }
  }).done((data) => {
    if(data){
      $('#order_' + id).hide('slow')
    }
  }).fail(e => {
    console.log(e)
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
    `                 <div class=\'orderItem__text orderItem__text--date\'>${date}</div>\n` +
    `                  <div class=\'orderItem__text orderItem__text--client\'>${clientName}</div>\n` +
    `                  <div class=\'orderItem__text orderItem__text--sum ${paidClass} \'>${sum}</div>\n` +
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