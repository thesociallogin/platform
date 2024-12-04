import { clsx } from 'clsx'

export function Heading({ className, as: Element = 'h2', dark = false, ...props }) {
  return (
    <Element
      {...props}
      data-dark={dark ? 'true' : undefined}
      className={clsx(className, 'text-pretty text-4xl font-medium tracking-tighter text-zinc-950 data-[dark]:text-white sm:text-6xl')}
    />
  )
}

export function Subheading({ className, as: Element = 'h2', dark = false, ...props }) {
  return (
    <Element
      {...props}
      data-dark={dark ? 'true' : undefined}
      className={clsx(className, 'font-mono text-xs/5 font-semibold uppercase tracking-widest text-zinc-500 data-[dark]:text-zinc-400')}
    />
  )
}

export function Lead({ className, ...props }) {
  return <p className={clsx(className, 'text-2xl font-medium text-zinc-500')} {...props} />
}
