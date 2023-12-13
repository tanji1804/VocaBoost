var counter = 1;

document.getElementById('add-button').addEventListener('click', function() {
  var inputFields = document.getElementById('input-fields');
  var template = inputFields.firstElementChild.cloneNode(true);
  
  template.querySelector('input[name="front[]"]').value = '';
  template.querySelector('input[name="back[]"]').value = '';
  
  template.querySelector('input[name="front[]"]').setAttribute('name', 'front[' + counter + ']');
  template.querySelector('input[name="back[]"]').setAttribute('name', 'back[' + counter + ']');
  
  inputFields.appendChild(template);
  counter++;
});
