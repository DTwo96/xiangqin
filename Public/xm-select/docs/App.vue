<template>
	<div id="app" class="xm-select-doc is-component">
		<main-header></main-header>
		<div class="main-cnt">
			<el-scrollbar class="page-component__scroll" ref="componentScrollBar">
				<div class="page-container page-component">
					<el-scrollbar class="page-component__nav">
						<side-nav :data="navsData" :base="``"></side-nav>
					</el-scrollbar>
					<div class="page-component__content">
						<router-view class="content"></router-view>
					</div>
					<el-backtop target=".page-component__scroll .el-scrollbar__wrap" :right="10" :bottom="150">
						<div class="base-backtop">
							<i class="layui-icon layui-icon-top" style="font-size: 40px;"></i>
						</div>
					</el-backtop>
				</div>
			</el-scrollbar>
		</div>
	</div>
</template>

<script>
	import navsData from './router.js';
	import throttle from 'throttle-debounce/throttle';
	import SideNav from './components/side-nav.vue';
    import MainHeader from './components/header.vue'

	export default {
		components: {
			SideNav, MainHeader
		},
		data() {
			return {
				lang: this.$route.meta.lang,
				navsData,
				scrollTop: 0,
				showHeader: true,
				componentScrollBar: null,
				componentScrollBoxElement: null
			};
		},
		watch: {
			'$route.path'() {
				// 触发伪滚动条更新
				this.componentScrollBox.scrollTop = 0;
				this.$nextTick(() => {
					this.componentScrollBar.update();
				});
			}
		},
		methods: {
			renderAnchorHref() {
				if (/changelog/g.test(location.href)) return;
				const anchors = document.querySelectorAll('h2 a,h3 a,h4 a,h5 a');
				const basePath = location.href.split('#').splice(0, 2).join('#');

				[].slice.call(anchors).forEach(a => {
					const href = a.getAttribute('href');
					a.href = basePath + href;
				});
			},

			goAnchor() {
				if (location.href.match(/#/g).length > 1) {
					const anchor = location.href.match(/#[^#]+$/g);
					if (!anchor) return;
					const elm = document.querySelector(anchor[0]);
					if (!elm) return;

					setTimeout(_ => {
						this.componentScrollBox.scrollTop = elm.offsetTop;
					}, 50);
				}
			},

			handleScroll() {
				const scrollTop = this.componentScrollBox.scrollTop;
				if (this.showHeader !== this.scrollTop > scrollTop) {
					this.showHeader = this.scrollTop > scrollTop;
				}
				if (scrollTop === 0) {
					this.showHeader = true;
				}
				if (!this.navFaded) {
					this.$emit('fadeNav');
				}
				this.scrollTop = scrollTop;
			}
		},
		created() {
			this.$on('navFade', val => {
				this.navFaded = val;
			});
		},
		mounted() {
			this.componentScrollBar = this.$refs.componentScrollBar;
			this.componentScrollBox = this.componentScrollBar.$el.querySelector('.el-scrollbar__wrap');
			this.throttledScrollHandler = throttle(300, this.handleScroll);
			this.componentScrollBox.addEventListener('scroll', this.throttledScrollHandler);
			this.renderAnchorHref();
			this.goAnchor();
			document.body.classList.add('is-component');
		},
		destroyed() {
			document.body.classList.remove('is-component');
		},
		beforeDestroy() {
			this.componentScrollBox.removeEventListener('scroll', this.throttledScrollHandler);
		},
		beforeRouteUpdate(to, from, next) {
			next();
			setTimeout(() => {
				const toPath = to.path;
				const fromPath = from.path;
				if (toPath === fromPath && to.hash) {
					this.goAnchor();
				}
				if (toPath !== fromPath) {
					document.documentElement.scrollTop = document.body.scrollTop = 0;
					this.renderAnchorHref();
				}
			}, 100);
		}
	};
</script>
<style lang="less">
	.page-component__scroll {
		height: calc(100% - 80px);
		margin-top: 80px;

		&>.el-scrollbar__wrap {
			overflow-x: auto;
		}
	}

	.base-backtop{
		height: 100%;
		width: 100%;
		box-shadow: 0 0 6px rgba(0,0,0, .12);
		text-align: center;
		background-color: rgb(0, 150, 136);
		line-height: 40px;
		color: #FFF;
	}

	.page-component {
		box-sizing: border-box;
		height: 100%;

		&.page-container {
			padding: 0;
		}

		.page-component__nav {
			width: 240px;
			position: fixed;
			top: 0;
			bottom: 0;
			margin-top: 80px;
			transition: padding-top .3s;

			&>.el-scrollbar__wrap {
				height: 100%;
				overflow-x: auto;
			}

			&.is-extended {
				padding-top: 0;
			}
		}

		.side-nav {
			height: 100%;
			padding-top: 50px;
			padding-bottom: 50px;
			padding-right: 0;

			&>ul {
				padding-bottom: 50px;
			}
		}

		.page-component__content {
			padding-left: 270px;
			padding-bottom: 100px;
			box-sizing: border-box;
		}

		.content {
			padding-top: 50px;

			pre{
				tab-size: 4;
			}

			&>h3 {
				margin: 55px 0 20px;
			}

			&>ul:not(.timeline) {
				margin: 10px 0;
				padding: 0 0 0 20px;
				font-size: 14px;
				color: #5e6d82;
				line-height: 2em;
			}

			&>table {
				border-collapse: collapse;
				width: 100%;
				background-color: #fff;
				font-size: 14px;
				margin-bottom: 45px;
				line-height: 1.5em;

				strong {
					font-weight: normal;
				}

				td,
				th {
					border-bottom: 1px solid #dcdfe6;
					padding: 15px;
					max-width: 250px;
				}

				th {
					text-align: left;
					white-space: nowrap;
					color: #909399;
					font-weight: normal;
				}

				td {
					color: #606266;
				}

				th:first-child,
				td:first-child {
					padding-left: 10px;
				}
			}
		}
	}

	@media (max-width: 768px) {
		.page-component {
			.page-component__nav {
				width: 100%;
				position: static;
				margin-top: 0;
			}

			.side-nav {
				padding-top: 0;
				padding-left: 50px;
			}

			.page-component__content {
				padding-left: 10px;
				padding-right: 10px;
			}

			.content {
				padding-top: 0;
			}

			.content>table {
				overflow: auto;
				display: block;
			}
		}
	}
</style>
