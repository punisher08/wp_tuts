<?php
/**
 * Elementor_Hello_World_Widget_2
 */
class Elementor_Hello_World_Widget_2 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'hello_world_widget_2';
	}

	public function get_title() {
		return esc_html__( 'Hello World 2', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'hello', 'world' ];
	}

	protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Hello world', 'elementor-addon' ),
			]
		);

        $this->add_control(
            'images',
            [
                'label' => __( 'Images', 'elementor' ),
                'type' => \Elementor\Controls_Manager::GALLERY,
            ]
        );
        $this->add_control(
            'columns',
            [
                'label' => __( 'Columns', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '2' => __( '2', 'elementor' ),
                    '3' => __( '3', 'elementor' ),
                    '4' => __( '4', 'elementor' ),
                ],
            ]
        );
        $this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Hello world', 'elementor-addon' ),
			]
		);
		$this->end_controls_section();

		// Content Tab End


		// Style Tab Start

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hello-world' => 'color: {{VALUE}};',
				],
			],
		);
       

       
		$this->end_controls_section();

		// Style Tab End

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<p class="hello-world">
			<?php echo $settings['title']; ?>
		</p>
       <?php
        $images = $settings['images'];
        $columns = $settings['columns'];

        if ( ! empty( $images ) ) {
            ?>
            <div class="image-row-widget">
                <div class="image-row-container columns-<?php echo esc_attr( $columns ); ?>">
                    <?php foreach ( $images as $image ) { ?>
                        <div class="image-row-item">
                            <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
        }

       ?>
	    <p class="hello-world">
			<?php echo $settings['description']; ?>
		</p>
		<?php
	}


}