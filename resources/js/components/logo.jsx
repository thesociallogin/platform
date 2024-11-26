'use client'

import { clsx } from 'clsx'
import { motion } from 'framer-motion'

export function Logo({ className }) {
  let transition = {
    duration: 0.5,
    ease: 'easeInOut'
  }

  return (
    <motion.svg
      variants={{ idle: {}, active: {} }}
      initial='idle'
      whileHover='active'
      width={127}
      height={34}
      viewBox='0 0 127 34'
      className={clsx(className, 'overflow-visible fill-white')}
    >
      <motion.g
        variants={{
          idle: { scale: 1, opacity: 1 },
          active: {
            scale: [1, 1.15, 1],
            opacity: [1, 0.75, 1],
            transition: {
              ...transition,
              delay: 0
            }
          }
        }}
      >
        <motion.path d='M19.5986 18.5005C18.7702 19.9354 16.9354 20.427 15.5005 19.5986C14.0656 18.7701 13.574 16.9354 14.4024 15.5005C15.2309 14.0656 17.0656 13.574 18.5005 14.4024C19.9354 15.2308 20.427 17.0656 19.5986 18.5005Z' />
      </motion.g>
      <motion.g
        variants={{
          idle: { scale: 1, opacity: 1 },
          active: {
            scale: [1, 1.1, 1],
            opacity: [1, 0.75, 1],
            transition: {
              ...transition,
              delay: 0.15
            }
          }
        }}
      >
        <path d='M23.2324 10.2074C22.6801 11.1639 21.4569 11.4917 20.5003 10.9394C19.5437 10.3871 19.216 9.16395 19.7683 8.20736C20.3205 7.25078 21.5437 6.92303 22.5003 7.47531C23.4569 8.0276 23.7846 9.25078 23.2324 10.2074Z' />
        <path d='M19.7683 25.7933C19.216 24.8367 19.5437 23.6135 20.5003 23.0612C21.4569 22.5089 22.6801 22.8367 23.2324 23.7933C23.7847 24.7498 23.4569 25.973 22.5003 26.5253C21.5437 27.0776 20.3206 26.7498 19.7683 25.7933Z' />
        <path d='M26 19C24.8954 19 24 18.1046 24 17C24 15.8955 24.8954 15 26 15C27.1046 15 28 15.8955 28 17C28 18.1046 27.1046 19 26 19Z' />
        <path d='M14.2324 25.7933C13.6801 26.7499 12.4569 27.0777 11.5003 26.5254C10.5437 25.9731 10.216 24.7499 10.7683 23.7933C11.3205 22.8367 12.5437 22.509 13.5003 23.0613C14.4569 23.6136 14.7846 24.8367 14.2324 25.7933Z' />
        <path d='M10.7682 10.2073C10.216 9.25078 10.5437 8.0276 11.5003 7.47532C12.4569 6.92303 13.6801 7.25078 14.2323 8.20737C14.7846 9.16395 14.4569 10.3871 13.5003 10.9394C12.5437 11.4917 11.3205 11.1639 10.7682 10.2073Z' />
        <path d='M8 19C6.89543 19 6 18.1045 6 17C6 15.8954 6.89543 15 8 15C9.10457 15 10 15.8954 10 17C10 18.1045 9.10457 19 8 19Z' />
      </motion.g>
      <motion.g
        variants={{
          idle: { scale: 1, opacity: 1 },
          active: {
            scale: [1, 1.1, 1],
            opacity: [1, 0.75, 1],
            transition: {
              ...transition,
              delay: 0.3
            }
          }
        }}
      >
        <path d='M25.8662 3.6447C25.5901 4.12299 24.9785 4.28686 24.5002 4.01072C24.0219 3.73458 23.858 3.12299 24.1342 2.6447C24.4103 2.1664 25.0219 2.00253 25.5002 2.27867C25.9785 2.55481 26.1424 3.1664 25.8662 3.6447Z' />
        <path d='M33 18C32.4477 18 32 17.5522 32 17C32 16.4477 32.4477 16 33 16C33.5522 16 34 16.4477 34 17C34 17.5522 33.5522 18 33 18Z' />
        <path d='M31.3556 9.86619C30.8773 10.1424 30.2658 9.97846 29.9896 9.50017C29.7135 9.02187 29.8773 8.41028 30.3556 8.13414C30.8339 7.858 31.4455 8.02187 31.7217 8.50017C31.9978 8.97846 31.8339 9.59005 31.3556 9.86619Z' />
        <path d='M30.3556 25.8662C29.8773 25.5901 29.7134 24.9785 29.9896 24.5002C30.2657 24.0219 30.8773 23.858 31.3556 24.1342C31.8339 24.4103 31.9978 25.0219 31.7216 25.5002C31.4455 25.9785 30.8339 26.1424 30.3556 25.8662Z' />
        <path d='M16 33C16 32.4477 16.4477 32 17 32C17.5523 32 18 32.4477 18 33C18 33.5523 17.5523 34 17 34C16.4477 34 16 33.5523 16 33Z' />
        <path d='M24.1341 31.3557C23.858 30.8774 24.0219 30.2658 24.5002 29.9896C24.9785 29.7135 25.5901 29.8774 25.8662 30.3557C26.1423 30.834 25.9785 31.4455 25.5002 31.7217C25.0219 31.9978 24.4103 31.834 24.1341 31.3557Z' />
        <path d='M9.8662 31.3556C9.59005 31.8339 8.97846 31.9978 8.50017 31.7216C8.02188 31.4455 7.858 30.8339 8.13415 30.3556C8.41029 29.8773 9.02188 29.7134 9.50017 29.9896C9.97846 30.2657 10.1424 30.8773 9.8662 31.3556Z' />
        <path d='M1 18C0.447715 18 -3.44684e-08 17.5523 0 17C3.44684e-08 16.4477 0.447715 16 1 16C1.55228 16 2 16.4477 2 17C2 17.5523 1.55228 18 1 18Z' />
        <path d='M3.6447 25.8662C3.1664 26.1424 2.55481 25.9785 2.27867 25.5002C2.00253 25.0219 2.1664 24.4103 2.6447 24.1342C3.12299 23.858 3.73458 24.0219 4.01072 24.5002C4.28686 24.9785 4.12299 25.5901 3.6447 25.8662Z' />
        <path d='M2.6447 9.8662C2.1664 9.59005 2.00253 8.97846 2.27867 8.50017C2.55481 8.02188 3.1664 7.858 3.6447 8.13415C4.12299 8.41029 4.28686 9.02188 4.01072 9.50017C3.73458 9.97846 3.12299 10.1424 2.6447 9.8662Z' />
        <path d='M16 1C16 0.447715 16.4477 -4.87226e-08 17 0C17.5523 4.87226e-08 18 0.447715 18 1C18 1.55228 17.5523 2 17 2C16.4477 2 16 1.55228 16 1Z' />
        <path d='M8.13415 3.6447C7.858 3.16641 8.02188 2.55482 8.50017 2.27867C8.97846 2.00253 9.59005 2.16641 9.8662 2.6447C10.1424 3.12299 9.97846 3.73458 9.50017 4.01072C9.02188 4.28687 8.41029 4.12299 8.13415 3.6447Z' />
      </motion.g>
      <path d='M51.606 25.5V10.54H54.07V25.5H51.606ZM57.436 18.988H53.388V17.47H57.106C58.03 17.47 58.734 17.25 59.218 16.81C59.7167 16.3553 59.966 15.7467 59.966 14.984C59.966 14.236 59.7167 13.642 59.218 13.202C58.734 12.7473 58.0447 12.52 57.15 12.52H53.388V10.54H57.216C58.8293 10.54 60.1127 10.9287 61.066 11.706C62.0193 12.4687 62.496 13.5173 62.496 14.852C62.496 16.2013 62.034 17.228 61.11 17.932C60.2007 18.636 58.976 18.988 57.436 18.988ZM60.604 25.5L59.702 21.496C59.57 20.924 59.394 20.4913 59.174 20.198C58.9687 19.9047 58.69 19.7067 58.338 19.604C57.986 19.5013 57.5387 19.45 56.996 19.45H53.806V17.866H57.348C58.3453 17.866 59.152 17.9613 59.768 18.152C60.3987 18.328 60.89 18.6433 61.242 19.098C61.594 19.5527 61.8727 20.1907 62.078 21.012L63.2 25.5H60.604ZM67.5094 17.602H65.1554C65.2874 16.7367 65.5661 15.996 65.9914 15.38C66.4168 14.764 66.9888 14.2947 67.7074 13.972C68.4261 13.6347 69.2694 13.466 70.2374 13.466C71.2934 13.466 72.1734 13.664 72.8774 14.06C73.5961 14.4413 74.1314 14.9767 74.4834 15.666C74.8354 16.3553 75.0114 17.1547 75.0114 18.064V22.64C75.0114 23.344 75.0408 23.916 75.0994 24.356C75.1728 24.796 75.2754 25.1773 75.4074 25.5H72.9434C72.8114 25.2067 72.7308 24.84 72.7014 24.4C72.6721 23.96 72.6574 23.5127 72.6574 23.058V18.086C72.6574 17.2353 72.4448 16.5827 72.0194 16.128C71.6088 15.6733 70.9561 15.446 70.0614 15.446C69.2988 15.446 68.7048 15.644 68.2794 16.04C67.8688 16.4213 67.6121 16.942 67.5094 17.602ZM72.9874 18.35V19.956C71.7848 19.956 70.8021 20.0147 70.0394 20.132C69.2768 20.2493 68.6828 20.418 68.2574 20.638C67.8321 20.8433 67.5388 21.0927 67.3774 21.386C67.2161 21.6647 67.1354 21.98 67.1354 22.332C67.1354 22.8307 67.3261 23.2267 67.7074 23.52C68.0888 23.7987 68.5874 23.938 69.2034 23.938C69.8634 23.938 70.4501 23.784 70.9634 23.476C71.4914 23.1533 71.9021 22.728 72.1954 22.2C72.5034 21.672 72.6574 21.1 72.6574 20.484H73.7134C73.6548 21.4227 73.4714 22.2293 73.1634 22.904C72.8554 23.5787 72.4594 24.1287 71.9754 24.554C71.5061 24.9793 70.9928 25.2947 70.4354 25.5C69.8781 25.6907 69.3208 25.786 68.7634 25.786C67.9714 25.786 67.2748 25.6613 66.6734 25.412C66.0721 25.1627 65.6028 24.7887 65.2654 24.29C64.9281 23.7913 64.7594 23.168 64.7594 22.42C64.7594 21.6133 64.9794 20.924 65.4194 20.352C65.8594 19.78 66.5194 19.34 67.3994 19.032C68.2208 18.7533 69.0714 18.57 69.9514 18.482C70.8314 18.394 71.8434 18.35 72.9874 18.35ZM82.3632 25.786C81.3365 25.786 80.4492 25.544 79.7012 25.06C78.9532 24.5613 78.3812 23.85 77.9852 22.926C77.5892 22.002 77.3912 20.9093 77.3912 19.648C77.3912 17.6533 77.8385 16.128 78.7332 15.072C79.6279 14.0013 80.8379 13.466 82.3632 13.466C83.6832 13.466 84.7319 13.994 85.5092 15.05C86.3012 16.106 86.6972 17.6387 86.6972 19.648C86.6972 20.9093 86.5212 22.002 86.1692 22.926C85.8172 23.8353 85.3112 24.5393 84.6512 25.038C84.0059 25.5367 83.2432 25.786 82.3632 25.786ZM82.6712 23.806C83.6099 23.806 84.3212 23.454 84.8052 22.75C85.3039 22.0313 85.5532 20.9973 85.5532 19.648C85.5532 18.2987 85.2965 17.2647 84.7832 16.546C84.2845 15.8127 83.5805 15.446 82.6712 15.446C81.7325 15.446 81.0139 15.8053 80.5152 16.524C80.0312 17.2427 79.7892 18.284 79.7892 19.648C79.7892 20.9827 80.0385 22.0093 80.5372 22.728C81.0505 23.4467 81.7619 23.806 82.6712 23.806ZM85.5532 25.5V9.66H87.9072V25.5H85.5532ZM90.7464 25.5V13.774H93.1004V25.5H90.7464ZM90.7464 12.322V9.66H93.1004V12.322H90.7464ZM98.1676 17.602H95.8136C95.9456 16.7367 96.2243 15.996 96.6496 15.38C97.075 14.764 97.647 14.2947 98.3656 13.972C99.0843 13.6347 99.9276 13.466 100.896 13.466C101.952 13.466 102.832 13.664 103.536 14.06C104.254 14.4413 104.79 14.9767 105.142 15.666C105.494 16.3553 105.67 17.1547 105.67 18.064V22.64C105.67 23.344 105.699 23.916 105.758 24.356C105.831 24.796 105.934 25.1773 106.066 25.5H103.602C103.47 25.2067 103.389 24.84 103.36 24.4C103.33 23.96 103.316 23.5127 103.316 23.058V18.086C103.316 17.2353 103.103 16.5827 102.678 16.128C102.267 15.6733 101.614 15.446 100.72 15.446C99.957 15.446 99.363 15.644 98.9376 16.04C98.527 16.4213 98.2703 16.942 98.1676 17.602ZM103.646 18.35V19.956C102.443 19.956 101.46 20.0147 100.698 20.132C99.935 20.2493 99.341 20.418 98.9156 20.638C98.4903 20.8433 98.197 21.0927 98.0356 21.386C97.8743 21.6647 97.7936 21.98 97.7936 22.332C97.7936 22.8307 97.9843 23.2267 98.3656 23.52C98.747 23.7987 99.2456 23.938 99.8616 23.938C100.522 23.938 101.108 23.784 101.622 23.476C102.15 23.1533 102.56 22.728 102.854 22.2C103.162 21.672 103.316 21.1 103.316 20.484H104.372C104.313 21.4227 104.13 22.2293 103.822 22.904C103.514 23.5787 103.118 24.1287 102.634 24.554C102.164 24.9793 101.651 25.2947 101.094 25.5C100.536 25.6907 99.979 25.786 99.4216 25.786C98.6296 25.786 97.933 25.6613 97.3316 25.412C96.7303 25.1627 96.261 24.7887 95.9236 24.29C95.5863 23.7913 95.4176 23.168 95.4176 22.42C95.4176 21.6133 95.6376 20.924 96.0776 20.352C96.5176 19.78 97.1776 19.34 98.0576 19.032C98.879 18.7533 99.7296 18.57 100.61 18.482C101.49 18.394 102.502 18.35 103.646 18.35ZM108.621 25.5V13.774H110.975V25.5H108.621ZM110.975 18.614H110.051C110.125 17.47 110.352 16.5167 110.733 15.754C111.129 14.9913 111.65 14.4193 112.295 14.038C112.941 13.6567 113.681 13.466 114.517 13.466C115.339 13.466 116.043 13.6273 116.629 13.95C117.216 14.258 117.671 14.7273 117.993 15.358C118.316 15.974 118.477 16.744 118.477 17.668V25.5H116.145V18.152C116.145 17.58 116.057 17.096 115.881 16.7C115.705 16.2893 115.449 15.974 115.111 15.754C114.774 15.534 114.334 15.424 113.791 15.424C113.351 15.424 112.955 15.5193 112.603 15.71C112.251 15.886 111.951 16.1207 111.701 16.414C111.467 16.7073 111.283 17.0447 111.151 17.426C111.034 17.8073 110.975 18.2033 110.975 18.614ZM121.648 22.002V11.068H124.002V21.87C124.002 22.5447 124.134 23.0433 124.398 23.366C124.677 23.6887 125.219 23.85 126.026 23.85H126.488V25.566C126.371 25.6393 126.173 25.6907 125.894 25.72C125.63 25.764 125.337 25.786 125.014 25.786C123.885 25.786 123.041 25.4707 122.484 24.84C121.927 24.2093 121.648 23.2633 121.648 22.002ZM120.064 15.6V13.774H126.532V15.6H120.064Z' />
    </motion.svg>
  )
}

export function Mark({ className }) {
  return (
    <svg viewBox='0 0 34 34' fill='none' className={className}>
      <path d='M19.598 18.5C18.7696 19.9349 16.9348 20.4265 15.4999 19.5981C14.065 18.7696 13.5734 16.9349 14.4018 15.5C15.2303 14.0651 17.065 13.5735 18.4999 14.4019C19.9348 15.2303 20.4264 17.0651 19.598 18.5Z' />
      <path d='M23.232 10.2058C22.6797 11.1623 21.4565 11.4901 20.4999 10.9378C19.5433 10.3855 19.2156 9.16235 19.7679 8.20576C20.3201 7.24918 21.5433 6.92143 22.4999 7.47371C23.4565 8.026 23.7842 9.24918 23.232 10.2058Z' />
      <path d='M19.7679 25.7944C19.2156 24.8378 19.5433 23.6146 20.4999 23.0623C21.4565 22.51 22.6797 22.8378 23.232 23.7944C23.7843 24.7509 23.4565 25.9741 22.4999 26.5264C21.5433 27.0787 20.3202 26.7509 19.7679 25.7944Z' />
      <path d='M25.9999 19.0001C24.8953 19.0001 23.9999 18.1047 23.9999 17.0001C23.9999 15.8956 24.8953 15.0001 25.9999 15.0001C27.1045 15.0001 27.9999 15.8956 27.9999 17.0001C27.9999 18.1047 27.1045 19.0001 25.9999 19.0001Z' />
      <path d='M14.232 25.7942C13.6797 26.7508 12.4565 27.0786 11.4999 26.5263C10.5433 25.974 10.2156 24.7508 10.7679 23.7942C11.3201 22.8376 12.5433 22.5099 13.4999 23.0622C14.4565 23.6145 14.7842 24.8376 14.232 25.7942Z' />
      <path d='M10.7679 10.2059C10.2157 9.24936 10.5434 8.02618 11.5 7.4739C12.4566 6.92161 13.6798 7.24936 14.232 8.20595C14.7843 9.16253 14.4566 10.3857 13.5 10.938C12.5434 11.4903 11.3202 11.1625 10.7679 10.2059Z' />
      <path d='M7.99999 19.0002C6.89542 19.0002 5.99999 18.1047 5.99999 17.0002C5.99999 15.8956 6.89542 15.0002 7.99999 15.0002C9.10456 15.0002 9.99999 15.8956 9.99999 17.0002C9.99999 18.1047 9.10456 19.0002 7.99999 19.0002Z' />
      <path d='M25.8659 3.64359C25.5898 4.12188 24.9782 4.28575 24.4999 4.00961C24.0216 3.73347 23.8577 3.12188 24.1339 2.64359C24.41 2.16529 25.0216 2.00142 25.4999 2.27756C25.9782 2.5537 26.1421 3.16529 25.8659 3.64359Z' />
      <path d='M33.0001 18.0002C32.4478 18.0002 32.0001 17.5524 32.0001 17.0002C32.0001 16.4479 32.4478 16.0002 33.0001 16.0002C33.5523 16.0002 34.0001 16.4479 34.0001 17.0002C34.0001 17.5524 33.5523 18.0002 33.0001 18.0002Z' />
      <path d='M31.3561 9.86594C30.8778 10.1421 30.2663 9.97821 29.9901 9.49992C29.714 9.02162 29.8778 8.41003 30.3561 8.13389C30.8344 7.85775 31.446 8.02162 31.7222 8.49992C31.9983 8.97821 31.8344 9.5898 31.3561 9.86594Z' />
      <path d='M30.3563 25.866C29.878 25.5899 29.7141 24.9783 29.9903 24.5C30.2664 24.0217 30.878 23.8578 31.3563 24.134C31.8346 24.4101 31.9985 25.0217 31.7223 25.5C31.4462 25.9783 30.8346 26.1422 30.3563 25.866Z' />
      <path d='M16.0001 33.0001C16.0001 32.4478 16.4478 32.0001 17.0001 32.0001C17.5524 32.0001 18.0001 32.4478 18.0001 33.0001C18.0001 33.5524 17.5524 34.0001 17.0001 34.0001C16.4478 34.0001 16.0001 33.5524 16.0001 33.0001Z' />
      <path d='M24.134 31.3566C23.8579 30.8783 24.0218 30.2667 24.5001 29.9905C24.9784 29.7144 25.59 29.8783 25.8661 30.3566C26.1422 30.8349 25.9784 31.4464 25.5001 31.7226C25.0218 31.9987 24.4102 31.8349 24.134 31.3566Z' />
      <path d='M9.86593 31.3564C9.58978 31.8347 8.97819 31.9986 8.4999 31.7224C8.02161 31.4463 7.85773 30.8347 8.13388 30.3564C8.41002 29.8781 9.02161 29.7142 9.4999 29.9904C9.97819 30.2665 10.1421 30.8781 9.86593 31.3564Z' />
      <path d='M1 18.0001C0.447715 18.0001 -3.44684e-08 17.5524 0 17.0001C3.44684e-08 16.4478 0.447715 16.0001 1 16.0001C1.55228 16.0001 2 16.4478 2 17.0001C2 17.5524 1.55228 18.0001 1 18.0001Z' />
      <path d='M3.64329 25.866C3.16499 26.1422 2.5534 25.9783 2.27726 25.5C2.00112 25.0217 2.16499 24.4101 2.64329 24.134C3.12158 23.8578 3.73317 24.0217 4.00931 24.5C4.28545 24.9783 4.12158 25.5899 3.64329 25.866Z' />
      <path d='M2.6435 9.86602C2.1652 9.58987 2.00133 8.97828 2.27747 8.49999C2.55361 8.0217 3.1652 7.85782 3.6435 8.13397C4.12179 8.41011 4.28566 9.0217 4.00952 9.49999C3.73338 9.97828 3.12179 10.1422 2.6435 9.86602Z' />
      <path d='M16.0001 1C16.0001 0.447715 16.4478 -4.87226e-08 17.0001 0C17.5524 4.87226e-08 18.0001 0.447715 18.0001 1C18.0001 1.55228 17.5524 2 17.0001 2C16.4478 2 16.0001 1.55228 16.0001 1Z' />
      <path d='M8.13398 3.64371C7.85783 3.16542 8.02171 2.55383 8.5 2.27768C8.97829 2.00154 9.58988 2.16542 9.86603 2.64371C10.1422 3.122 9.97829 3.73359 9.5 4.00973C9.02171 4.28588 8.41012 4.122 8.13398 3.64371Z' />
    </svg>
  )
}
