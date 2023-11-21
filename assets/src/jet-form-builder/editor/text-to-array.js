const {
		  TextControl,
		  ToggleControl,
		  TextareaControl,
	  } = wp.components;

const {
		  addAction,
	  } = JetFBActions;

addAction( 'jfbc_text_to_array', function TextToArray( {
											   settings, 
											   label,
											   onChangeSetting,
										   } ) {

	return <>
		<TextControl
			label={ label( 'text_field' ) }
			value={ settings.text_field }
			onChange={ newVal => onChangeSetting( newVal, 'text_field' ) }
		/>
		<TextControl
			label={ label( 'lines_per_item' ) }
			value={ settings.lines_per_item }
			onChange={ newVal => onChangeSetting( newVal, 'lines_per_item' ) }
		/>
		<TextareaControl
			label={ label( 'keys' ) }
			value={ settings.keys }
			onChange={ newVal => onChangeSetting( newVal, 'keys' ) }
		/>
		<TextControl
			label={ label( 'array_field' ) }
			value={ settings.array_field }
			onChange={ newVal => onChangeSetting( newVal, 'array_field' ) }
		/>
	</>;
} );
