<?php 
$this->_view_data['header_title'] = 'React Page';
//$this->ut->debug($this->Auth, 'auth'); 

?>
<p />


<div id="my-widget"></div>

<script type="text/babel">
  function MyWidget() {
    const [count, setCount] = React.useState(0);
    return (
      <button onClick={() => setCount(count + 1)}>
        Clicked {count} times
      </button>
    );
  }

  ReactDOM.createRoot(document.getElementById('my-widget')).render(<MyWidget />);
</script>
<p />
Drag and Drop
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<ul id="my-list">
  <li>Item 1</li>
  <li>Item 2</li>
  <li>Item 3</li>
  <li>Item 4</li>
</ul>

<script>
  Sortable.create(document.getElementById('my-list'));
</script>