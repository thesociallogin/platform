import { Button } from '@/components/ui/button.jsx'
import { motion } from 'framer-motion'

export default function CTA() {
  return (
    <section className='w-full bg-blue-500 py-12 text-white md:py-24 lg:py-32'>
      <div className='container mx-auto max-w-6xl px-4 md:px-6'>
        <motion.div
          className='flex flex-col items-center space-y-4 text-center'
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5 }}
        >
          <motion.h2
            className='text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl'
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.2, duration: 0.5 }}
          >
            Ready to Simplify Your Authentication?
          </motion.h2>
          <motion.p
            className='mx-auto max-w-[700px] text-xl'
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.4, duration: 0.5 }}
          >
            Join thousands of companies that trust The Social Login for their SSO needs.
          </motion.p>
          <motion.div initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ delay: 0.6, duration: 0.5 }}>
            <Button>Get Started Now</Button>
          </motion.div>
        </motion.div>
      </div>
    </section>
  )
}
