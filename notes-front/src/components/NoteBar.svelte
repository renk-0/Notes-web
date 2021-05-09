<script>
	import {createEventDispatcher} from "svelte";
	const dispatcher = createEventDispatcher();

	let editing = false;
	
	const edit_file = () => change_switch(true);
	const preview_file = () => change_switch(false);

	const save_changes = () => dispatcher("save_changes");
	function change_switch(stat) {
		if(editing == stat) return;
		editing = stat;
		dispatcher("changed_switch");
	}
</script>

<div class="note_menu_bar">
	<div class="switcher">
	<button class="opt1" 
			on:click={preview_file}
			class:selected={!editing}> 
		Preview
	</button>
	<button class="opt2" 
			on:click={edit_file}
			class:selected={editing}>
		Edit
	</button>
	</div>
	<div class="expander"></div>
	<button class="save_button" on:click={save_changes}>Save</button>
</div>


<style>
	.note_menu_bar {
		display: flex;
		padding: 15px;
		border: 0 solid var(--snd-border-col);
		border-bottom-width: 2px;
	}

	.save_button {
		color: var(--green);
		background: var(--snd-background);
		border-color: var(--green);
	}

	/*
	 * SWITCHER STYLE
	 * */
	.switcher {
		display: inline-flex;
		border: 2px solid var(--snd-border-col);
		border-radius: 10px;
		overflow: hidden;
	}
	.switcher button {
		transition: all ease-in-out 0.1s;
		border-radius: 0;
		border: none;
		font-weight: normal;
	}
	.switcher .opt1 { border-right: 2px solid var(--snd-border-col); }
	.switcher button.selected {
		background: var(--aqua);
		color: var(--background);
		font-weight: bold;
	}
</style>
