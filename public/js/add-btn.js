var counter = 1;

document.getElementById('add-button').addEventListener('click', function() {
  var inputFields = document.getElementById('input-fields');
  var template = inputFields.firstElementChild.cloneNode(true);
  
  // name属性とvalue属性を更新する
  template.querySelector('input[name="front[]"]').setAttribute('name', 'front[' + counter + ']');
  template.querySelector('input[name="back[]"]').setAttribute('name', 'back[' + counter + ']');
  
  inputFields.appendChild(template);
  counter++;
});
