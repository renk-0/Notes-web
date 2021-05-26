<script>
	import Bar from "./components/Bar.svelte";
	import Boxes from "./components/Boxes.svelte";
	import ModalBox from "./components/ModalBox.svelte";
	import ModalNote from "./components/ModalNote.svelte";
	import NoteView from "./components/NoteView.svelte";

	let menu, bModal, nModal, noteView, boxList;
</script>
	
<div id="main">
	<!-- MODALS -->
	<ModalNote bind:this={nModal} {boxList} />
	<ModalBox bind:this={bModal} {boxList} />

	<!-- MENU BAR -->
	<Bar bind:this={menu} 
		on:folder={bModal.toggle} 
		on:note={nModal.toggle} />

	<div class="note_app_container">
		<!-- BOXES MENU -->		
		<Boxes bind:this={boxList}
			on:view_note={noteView.put_note}
			on:box_selected={nModal.select_box}/>
		
		<!-- VISTA DE NOTAS -->
		<NoteView bind:this={noteView} />
	</div>
</div>

<style>
	#main {
		width: 100vw;
		height: 100vh;
		min-width: 200px;
		min-height: 300px;
		padding: 1em;
		display: flex;
		flex-flow: column nowrap;
		box-sizing: border-box;
	}

	.note_app_container {
		margin: 0 5%;
		margin-top: 1rem;
		overflow: hidden;
		display: flex;
		box-sizing: border-box;
		border: 2px solid var(--snd-border-col);
		border-radius: 10px;
		height: 100%;
		flex-flow: row wrap;
	}
</style>

