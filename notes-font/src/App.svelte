<script>
	import Bar from "./components/Bar.svelte";
	import ModalBox from "./components/ModalBox.svelte";
	import axios from "axios";
	
	let menuBar, notesBrowser, newBoxModal, newNoteModal;
	let boxes = [], currentItem;

	const addBox = (e) => { boxes.push(e.detail); console.log(boxes)};
	function getBoxes() {
		boxes = undefined;
		axios.get("http://localhost/Notas/getBoxes")
			.then(resp => { boxes = resp.data; console.log(boxes) });
	}; getBoxes();
</script>

<div id="main">
	<ModalBox bind:this={newBoxModal} on:added={addBox} />
	<Bar on:folder={newBoxModal.toggle} />
</div>

<style>
	
</style>
