<script>
	import Bar from "./components/Bar.svelte";
	import ModalBox from "./components/ModalBox.svelte";
	import ModalNote from "./components/ModalNote.svelte";
	import BoxesSide from "./components/BoxesSide.svelte";
	import axios from "axios";
	
	let menuBar, notesBrowser, newBoxModal, newNoteModal;
	let boxes = [];
	let currentBox = undefined;

	const addBox = (e) => { boxes[boxes.length] = e.detail; console.log(boxes) };
	const createdNote = (e) => currentBox.addNote(e.detail);
	function getBoxes() {
		axios.get("http://localhost/Notas/getBoxes")
			.then(resp => { boxes = resp.data; console.log(boxes) });
	}; getBoxes();
</script>

<div id="main">
	<ModalBox bind:this={newBoxModal} on:added={addBox} />
	<ModalNote {currentBox} bind:this={newNoteModal} on:newNote={createdNote} />

	<Bar bind:this={menuBar} 
		on:folder={newBoxModal.toggle} 
		on:note={newNoteModal.toggle} />
	<BoxesSide bind:this={notesBrowser} {boxes} />
</div>

<style>
	
</style>
